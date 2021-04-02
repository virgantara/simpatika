<?php
namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\DataDiri;
use app\models\Tendik;
use app\models\Pengajaran;
use app\models\CatatanHarian;
use app\models\Organisasi;
use app\models\PengelolaJurnal;
use app\models\TugasDosenBkd;
use app\models\Penelitian;
use app\models\Publikasi;
use app\models\Pengabdian;
use app\models\Penghargaan;
use app\models\MasterLevel;
use app\models\GameLevelClass;
use app\models\Prodi;
use app\models\User;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use \Firebase\JWT\JWT;
use yii\httpclient\Client;

/**
 * Site controller
 */
class SiteController extends AppController
{
    public $successUrl = '';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page');
                },
                'only' => ['logout', 'signup','testing'],
                'rules' => [
                    [
                        'actions' => [
                            'testing'
                        ],
                        'allow' => true,
                        'roles' => ['theCreator'],
                    ],
                    [
                        'actions' => ['signup','test'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => $this->successUrl
            ],
        ];
    }

    public function actionAjaxCariUser() {

        $q = $_GET['term'];
        
        $query = DataDiri::find();
        $query->where(['LIKE','nama',$q]);
        $query->orWhere(['LIKE','NIY',$q]);
        $query->limit(10);
        $result1 = $query->asArray()->all();

        $query = Tendik::find();
        $query->where(['LIKE','nama',$q]);
        $query->orWhere(['LIKE','NIY',$q]);
        $query->limit(10);
        $result2 = $query->asArray()->all();
        $result = array_merge($result1, $result2);
        $out = [];

        // print_r($result);exit;
        if(count($result) > 0)
        {
            foreach ($result as $d) {
                $d = (object)$d;
                $out[] = [
                    'id' => $d->NIY,
                    'niy' => $d->NIY,
                    'label'=> $d->NIY.' - '.$d->nama,

                ];
            }
        }

        else
        {

           
            $out[] = [
                'id' => 0,
                'label'=> 'Data user tidak ditemukan',

            ];
            
        }
        
        

        echo \yii\helpers\Json::encode($out);


    }

    public function actionChange()
    {

        $id = Yii::$app->user->identity->id;
        // load user data
        $user = \app\models\User::findOne($id);

        $auth = Yii::$app->authManager;

        // get user role if he has one  
        if ($roles = $auth->getRolesByUser($id)) {
            // it's enough for us the get first assigned role name
            $role = array_keys($roles)[0]; 
        }

        // if user has role, set oldRole to that role name, else offer 'member' as sensitive default
        $oldRole = (isset($role)) ? $auth->getRole($role) : $auth->getRole('Dosen');

        // set property item_name of User object to this role name, so we can use it in our form
        $user->item_name = $oldRole->name;

        if (!$user->load(Yii::$app->request->post())) {
            return $this->render('change', ['user' => $user, 'role' => $user->item_name]);
        }

        // only if user entered new password we want to hash and save it
        if ($user->password) {
            $user->setPassword($user->password);
        }

        // // if admin is activating user manually we want to remove account activation token
        // if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null) {
        //     $user->removeAccountActivationToken();
        // }         
        
        $user->access_role = $user->item_name;
        if (!$user->save()) {
            return $this->render('change', ['user' => $user, 'role' => $user->item_name]);
        }

        // take new role from the form
        $newRole = $auth->getRole($user->item_name);
        // get user id too
        $userId = $user->getId();
        
        // we have to revoke the old role first and then assign the new one
        // this will happen if user actually had something to revoke
        if ($auth->revoke($oldRole, $userId)) {
            $info = $auth->assign($newRole, $userId);
        }

        // in case user didn't have role assigned to him, then just assign new one
        if (!isset($role)) {
            $info = $auth->assign($newRole, $userId);
        }

        if (!$info) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error while saving user role.'));
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'Role changed successfuly.'));
        return $this->redirect(['change', 'id' => $user->id]);
        
        
    }


    public function actionAjaxTahunList()
    {
        $api_baseurl = Yii::$app->params['api_baseurl'];
        $client = new Client(['baseUrl' => $api_baseurl]);
        $client_token = Yii::$app->params['client_token'];
        $headers = ['x-access-token'=>$client_token];

        $results = [];
        // foreach($listTahun as $tahun)
        // {
        $params = [
            
        ];

        $response = $client->get('/tahun/list', $params,$headers)->send();
         // print_r($params);exit;
        if ($response->isOk) {
            $results = $response->data['values'];
            
        }

        // }

        echo \yii\helpers\Json::encode($results);
        die();
    }

    public function actionAuthCallback()
    {

        // $input = json_decode(file_get_contents('php://input'),true);
        // header('Content-type:application/json;charset=utf-8');

        $results = [];
         
        try
        {
            $token = $_SERVER['HTTP_X_JWT_TOKEN'];
            $key = Yii::$app->params['jwt_key'];
            $decoded = JWT::decode($token, base64_decode(strtr($key, '-_', '+/')), ['HS256']);
            $results = [
                'code' => 200,
                'message' => 'Valid'
            ];   
        }
        catch(\Exception $e) 
        {

            $results = [
                'code' => 500,
                'message' => $e->getMessage()
            ];
        }

        echo json_encode($results);

        die();
        
       
    }

    public function actionLoginSso($token)
    {
        // print_r($token);exit;
        
        $key = Yii::$app->params['jwt_key'];
        $decoded = JWT::decode($token, base64_decode(strtr($key, '-_', '+/')), ['HS256']);
        
        $uuid = $decoded->uuid; // will print "1"
        $user = \app\models\User::find()
            ->where([
                'uuid'=>$uuid,
            ])
            ->one();

        if(!empty($user))
        {
            
            $session = Yii::$app->session;
            $session->set('token',$token);
            $api_baseurl = Yii::$app->params['api_baseurl'];
            $client = new Client(['baseUrl' => $api_baseurl]);
            $client_token = Yii::$app->params['client_token'];
            $headers = ['x-access-token'=>$client_token];

            $results = [];
            // foreach($listTahun as $tahun)
            // {
            $params = [
                
            ];

            $response = $client->get('/tahun/aktif', $params,$headers)->send();
             
            $tahun_akademik = '';

            if ($response->isOk) {
                $results = $response->data['values'];
                if(!empty($results[0]))
                {
                    $tahun_akademik = $results[0];
                }
            }

            $pengajaran = Pengajaran::find()->where([
                'NIY' => $user->NIY,
                // 'is_claimed' => 1,
                'tahun_akademik' => $tahun_akademik['tahun_id']
            ])->all();

            // print_r($tahun_akademik);exit;

            $query = Publikasi::find()->where([
                'NIY' => $user->NIY,
                'is_claimed' => 1,
            ]);

            $query->andWhere(['not',['kegiatan_id' => null]]);

            $sd = $tahun_akademik['kuliah_mulai'];
            $ed = $tahun_akademik['nilai_selesai'];

            $totalCatatanHarian = $this->sumPoinCatatanHarian($sd, $ed, $user->ID);

            $query->andFilterWhere(['between','tanggal_terbit',$sd, $ed]);
            $query->orderBy(['tanggal_terbit'=>SORT_ASC]);

            $publikasi = $query->all();

            $query = Pengabdian::find()->where([
                'NIY' => $user->NIY,
                'is_claimed' => 1,
            ]);

            // $sd = $tahun_akademik['kuliah_mulai'];
            // $ed = $tahun_akademik['nilai_selesai'];

            // $query->andFilterWhere(['between','tahun_kegiatan',$sd, $ed]);
            $query->orderBy(['tahun_kegiatan'=>SORT_ASC]);

            $pengabdian = $query->all();

            $query = Organisasi::find()->where([
                'NIY' => $user->NIY,
                'is_claimed' => 1,
            ]);

            $organisasi = $query->all();

            $query = PengelolaJurnal::find()->where([
                'NIY' => $user->NIY,
                'is_claimed' => 1,
            ]);

            $pengelolaJurnal = $query->all();
            $total_abdi = 0;
            $total_penunjang = 0;
            $total_ajar = 0;
            $total_pub = 0;
            $total_ajar = 0; 
            foreach ($pengajaran as $key => $value) 
            {
                $total_ajar += $value->sks_bkd;
            }

            foreach ($publikasi as $key => $value) 
            {
                $total_pub += $value->sks_bkd;
            }

            foreach ($pengabdian as $key => $value) 
            {
                $total_abdi += $value->nilai;
            }

            foreach ($organisasi as $key => $value) 
            {
                $total_penunjang += $value->sks_bkd;
            }
            foreach ($pengelolaJurnal as $key => $value) 
            {
                $total_penunjang += $value->sks_bkd;
            }

            $total_bkd = $total_ajar+$total_pub+$total_abdi+$total_penunjang;

            $exp = $total_bkd * 1000;
            $exp += $totalCatatanHarian;
            $level = MasterLevel::getLevel($exp);
            $currentClass = GameLevelClass::getCurrentClass($level);
            $nextLevel = MasterLevel::getNextLevel($exp);
            $remainingExp = $nextLevel['nextExp'] - $exp;

            $session->set('level',$level);
            $session->set('class',$currentClass['class']);
            $session->set('rank',$currentClass['rank']);
            $session->set('stars',$currentClass['stars']);
            $session->set('remainingExp',$remainingExp);

            Yii::$app->user->login($user);
            return $this->redirect(['site/index']);
        }

        else{
            
            
            return $this->redirect($decoded->iss.'/site/sso-callback?code=302')->send();
        }
       
    }

    public function actionLoginOtp($otp)
    {
        
        $user = User::find()
            ->where([
                'otp'=>$otp,
            ])
            ->one();

        if(!empty($user)){
            $user->otp = null;
            $user->save(false,['otp']);
            Yii::$app->user->login($user);
            return $this->goHome();
        }

        else{
            Yii::$app->session->setFlash('error', Yii::t('app', 'Invalid OTP. Please contact your department administrator.'));
            
            return $this->redirect(['site/login']);
        }
        
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        $user = User::find()
            ->where([
                'email'=>$attributes['email'],
            ])
            ->one();

        if(!empty($user)){
            
            Yii::$app->user->login($user);
        }

        else{
            Yii::$app->session->setFlash('error', Yii::t('app', 'Invalid or Unregistered Email. Please use a valid unida.gontor.ac.id email address.'));
            
            return $this->redirect(['site/login']);
        }
        
    }

    protected function calcAchievement($params){

        $pengajaran = $params['pengajaran'];
        $publikasi = $params['publikasi'];
        $pengabdian = $params['pengabdian'];
        $organisasi = $params['organisasi'];
        $pengelolaJurnal = $params['pengelolaJurnal'];
        $bkd_ajar = $params['bkd_ajar'];
        $bkd_pub = $params['bkd_pub'];
        $bkd_abdi = $params['bkd_abdi'];
        $bkd_penunjang = $params['bkd_penunjang'];

        $total_abdi = 0;
        $total_penunjang = 0;
        $total_ajar = 0;
        $total_pub = 0;
        $total_ajar = 0; 
        foreach ($pengajaran as $key => $value) 
        {
            $total_ajar += $value->sks_bkd;
        }

        foreach ($publikasi as $key => $value) 
        {
            $total_pub += $value->sks_bkd;
        }

        foreach ($pengabdian as $key => $value) 
        {
            $total_abdi += $value->nilai;
        }

        foreach ($organisasi as $key => $value) 
        {
            $total_penunjang += $value->sks_bkd;
        }
        foreach ($pengelolaJurnal as $key => $value) 
        {
            $total_penunjang += $value->sks_bkd;
        }

        $total_bkd = $total_ajar+$total_pub+$total_abdi+$total_penunjang;

        $exp = $total_bkd * 1000;
        $exp += $results['totalCatatanHarian'];
        $level = MasterLevel::getLevel($exp);
        $currentClass = GameLevelClass::getCurrentClass($level);
        $nextLevel = MasterLevel::getNextLevel($exp);
        $remainingExp = $nextLevel['nextExp'] - $exp;

        $persen_a = 0;
        $persen_b = 0;
        $persen_c = 0;
        $persen_d = 0;
        $label_a = '';
        $label_b = '';
        $label_c = '';
        $label_d = '';

        if($bkd_ajar->nilai_minimal > 0){
            $persen_a = round(($total_ajar) / ($bkd_ajar->nilai_minimal) * 100,2);
            if($persen_a >= 100){
                $label_a = 'progress-bar-success';
            }

            else if($persen_a > 50){
                $label_a = 'progress-bar-warning';
            }

            else {
                $label_a = 'progress-bar-danger';
            }
        }

        if($bkd_pub->nilai_minimal > 0){
            $persen_b = round(($total_pub) / ($bkd_pub->nilai_minimal) * 100,2);
            if($persen_b >= 100){
                $label_b = 'progress-bar-success';
            }

            else if($persen_b > 50){
                $label_b = 'progress-bar-warning';
            }

            else {
                $label_b = 'progress-bar-danger';
            }
        }

        if($bkd_abdi->nilai_minimal > 0){
            $persen_c = round(($total_abdi) / ($bkd_abdi->nilai_minimal) * 100,2);
            if($persen_c >= 100){
                $label_c = 'progress-bar-success';
            }

            else if($persen_c > 50){
                $label_c = 'progress-bar-warning';
            }

            else {
                $label_c = 'progress-bar-danger';
            }
        }

        if($bkd_penunjang->nilai_minimal > 0){
            $persen_d = round(($total_penunjang) / ($bkd_penunjang->nilai_minimal) * 100,2);
            if($persen_d >= 100){
                $label_d = 'progress-bar-success';
            }

            else if($persen_d > 50){
                $label_d = 'progress-bar-warning';
            }

            else {
                $label_d = 'progress-bar-danger';
            }
        }
        $results = [
            'exp' => [
                'currentClass' => $currentClass,
                'remainingExp' => $remainingExp,
                'level' => $level
            ],
            'persen' => [
                'a' => $persen_a,
                'b' => $persen_b,
                'c' => $persen_c,
                'd' => $persen_d,
            ],
            'label' => [
                'a' => $label_a,
                'b' => $label_b,
                'c' => $label_c,
                'd' => $label_d,
            ],
        ];
        return $results;
    }

    protected function sumPoinCatatanHarian($sd, $ed, $user_id)
    {
        $query = CatatanHarian::find()->where(['user_id'=>$user_id]);
        $query->andFilterWhere(['between','tanggal',$sd, $ed]);
        return $query->sum('poin');
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $user = \app\models\User::findOne(Yii::$app->user->identity->ID);
        $api_baseurl = Yii::$app->params['api_baseurl'];
        $client = new Client(['baseUrl' => $api_baseurl]);
        $client_token = Yii::$app->params['client_token'];
        $headers = ['x-access-token'=>$client_token];

        $results = [];
        // foreach($listTahun as $tahun)
        // {
        $params = [
            
        ];

        $response = $client->get('/tahun/aktif', $params,$headers)->send();
         
        $tahun_akademik = '';

        if ($response->isOk) {
            $results = $response->data['values'];
            if(!empty($results[0]))
            {
                $tahun_akademik = $results[0];
            }
        }

        $pengajaran = Pengajaran::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            // 'is_claimed' => 1,
            'tahun_akademik' => $tahun_akademik['tahun_id']
        ])->all();

        // print_r($tahun_akademik);exit;

        $query = Publikasi::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $query->andWhere(['not',['kegiatan_id' => null]]);

        $sd = $tahun_akademik['kuliah_mulai'];
        $ed = $tahun_akademik['nilai_selesai'];

        $totalCatatanHarian = $this->sumPoinCatatanHarian($sd, $ed, Yii::$app->user->identity->ID);

        $query->andFilterWhere(['between','tanggal_terbit',$sd, $ed]);
        $query->orderBy(['tanggal_terbit'=>SORT_ASC]);

        $publikasi = $query->all();

        $query = Pengabdian::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        // $sd = $tahun_akademik['kuliah_mulai'];
        // $ed = $tahun_akademik['nilai_selesai'];

        // $query->andFilterWhere(['between','tahun_kegiatan',$sd, $ed]);
        $query->orderBy(['tahun_kegiatan'=>SORT_ASC]);

        $pengabdian = $query->all();

        $query = Organisasi::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $organisasi = $query->all();

        $query = PengelolaJurnal::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $pengelolaJurnal = $query->all();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'AJAR'
        ]);

        $bkd_ajar = $query->one();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'RISET'
        ]);

        $bkd_pub = $query->one();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'ABDIMAS'
        ]);

        $bkd_abdi = $query->one();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'PENUNJANG'
        ]);

        $bkd_penunjang = $query->one();

        $listColumns = Yii::$app->db->createCommand('SHOW COLUMNS FROM data_diri')->queryAll();

        $countNotEmpty = 0;
        foreach($listColumns as $col)
        {
            $tmp = Yii::$app->db->createCommand('SELECT '.$col['Field'].' FROM data_diri WHERE '.$col['Field'].' IS NOT NULL AND NIY = "'.Yii::$app->user->identity->NIY.'" ')->queryOne();

            if(isset($tmp))
                $countNotEmpty++;
            

        }

        $persentaseProfil = round($countNotEmpty / count($listColumns) * 100,2);
        // print_r($countNotEmpty);exit;
        $results = [
            'totalCatatanHarian' => $totalCatatanHarian,
            'persentaseProfil' => $persentaseProfil
        ];
        return $this->render('index',[
            'pengajaran' => $pengajaran,
            'results' => $results,
            'publikasi' => $publikasi,
            'pengabdian' => $pengabdian,
            'organisasi' => $organisasi,
            'pengelolaJurnal' => $pengelolaJurnal,
            'tahun_akademik' =>   $tahun_akademik,
            'bkd_ajar' => $bkd_ajar,
            'bkd_pub' => $bkd_pub,
            'bkd_abdi' => $bkd_abdi,
            'bkd_penunjang' => $bkd_penunjang,
            'tahun_akademik' =>   $tahun_akademik  
        ]);
        
    }

    public function actionHomelog()
    {

        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{ 
            $user = \app\models\User::findByEmail(Yii::$app->user->identity->email);
            $model = $user->dataDiri;
            return $this->render('homelog',['model'=>$model,]);
        }
    }


    public function actionUbahAkun()
    {
        $id = Yii::$app->user->identity->ID;
        // load user data
        $user = User::findOne($id);

        if (!$user->load(Yii::$app->request->post())) {
            return $this->render('ubahAkun', ['user' => $user]);
        }

        // only if user entered new password we want to hash and save it
        if ($user->password) {
            $user->setPassword($user->password);
        }


        if (!$user->save()) {
            return $this->render('ubahAkun', ['user' => $user]);
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'Data user telah diupdate.'));
        return $this->redirect(['ubah-akun']);
    }
        
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                $usernya = User::findOne(['NIY'=>Yii::$app->user->identity->NIY]);
                if($usernya->status_admin == 'user'){
                    $model = DataDiri::findOne(['NIY'=>Yii::$app->user->identity->NIY]);
                    return $this->render('homelog',['model'=>$model,]);
                }
                Yii::$app->user->logout();
                Yii::$app->getSession()->setFlash('danger','You are admin dude!!!');
                return $this->render('login', [
                    'model' => $model,]);
            }
            return $this->render('login', [
                'model' => $model,]);
        } else {
            return $this->render('login', [
                'model' => $model,]);
        }
        
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        
        $session = Yii::$app->session;
        $session->remove('token');
        Yii::$app->user->logout();
        $url = Yii::$app->params['sso_logout'];
        return $this->redirect($url);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
