<?php

namespace app\controllers;

use Yii;
use app\helpers\MyHelper;
use app\models\Prodi;
use app\models\User;
use app\models\MJenjangPendidikan;
use app\models\BidangKepakaran;
use app\models\BidangIlmu;
use app\models\DataDiri;
use app\models\DataDiriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Query;
use yii\helpers\Json;
use yii\httpclient\Client;
/**
 * DataDiriController implements the CRUD actions for DataDiri model.
 */
class DataDiriController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionAjaxCariDosenSimpeg() {

        $q = $_GET['term'];
        
        $query = DataDiri::find();
        $query->where(['LIKE','nama',$q]);
        $query->limit(10);
        $results = $query->all();
        
        $out = [];

        foreach ($results as $key => $value) {
            $out[] = [
                'id' => $value->nIY->ID,
                'niy' => $value->NIY,
                'label' => $value->nama
            ];
        }

        
        echo \yii\helpers\Json::encode($out);

        die();
    }

    public function actionInpassing()
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }

        $user = User::findOne(Yii::$app->user->identity->ID);
        $sisterToken = MyHelper::getSisterToken();
            
        $sister_baseurl = Yii::$app->params['sister_baseurl'];
        $headers = ['content-type' => 'application/json'];
        $client = new \GuzzleHttp\Client([
            'timeout'  => 5.0,
            'headers' => $headers,
            // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
        ]);
        $full_url = $sister_baseurl.'/Inpassing';
        $response = $client->post($full_url, [
            'body' => json_encode([
                'id_token' => $sisterToken,
                'id_dosen' => $user->sister_id,
                'updated_after' => [
                    'tahun' => '2000',
                    'bulan' => '01',
                    'tanggal' => '01'
                ]
            ]), 
            'headers' => ['Content-type' => 'application/json']

        ]); 
        
        $results = [];
       
        $response = json_decode($response->getBody());
        if($response->error_code == 0){
            $results = $response->data;
        }

        else if($response->error_code == 100){
            if(!MyHelper::wsSisterLogin()){
                throw new \Exception("Error Creating SISTER Token", 1);
                
            }
        }

        return $this->render('inpassing',[
            'results' => $results
        ]);
    }

    public function actionList($jenjang, $pangkat)
    {
    
        $jf = \common\models\MJabatanAkademik::find()->where(['kode'=>$pangkat])->one();
        $searchModel = new DataDiriSearch();
        $dataProvider = $searchModel->searchList($jenjang, $jf->id);
        
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionGetDosen($q = null) {
        

        $query = new Query;
    
        $query->select('NIY, nama')
            ->from('data_diri')
            ->where('nama LIKE "%' . $q .'%" OR NIY LIKE "%' . $q .'%"')
            ->orderBy('nama')
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = [
                'niy' => $d['NIY'],
                'nama' => $d['nama'],
                
            ];
        }
        echo Json::encode($out);
    }

    /**
     * Lists all DataDiri models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new DataDiriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single DataDiri model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DataDiri model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $api_baseurl = Yii::$app->params['api_baseurl'];
        $client = new Client(['baseUrl' => $api_baseurl]);
        $client_token = Yii::$app->params['client_token'];
        $headers = ['x-access-token'=>$client_token];
        $response = $client->get('/k/list', [],$headers)->send();
        $listKampus = [];
        if ($response->isOk) 
        {
            $tmp = $response->data['values'];
            foreach($tmp as $t)
                $listKampus[$t['kode_kampus']] = $t['nama_kampus'];
        }
        $model = DataDiri::findOne(['NIY'=>Yii::$app->user->identity->NIY]);
        
        if(empty($model))
            $model = new DataDiri();

        $sementara = $model->f_foto;

        $f_foto = $model->f_foto;   

        $query = BidangIlmu::find()->where(['bidang_ilmu.level'=>2]);
        $query->joinWith(['kode0 as k']);
        $query->orderBy(['k.nama'=>SORT_ASC]);
        $listBidangIlmu = $query->all();

        $listKepakaran = BidangKepakaran::find()->where(['level' => 1])->all();
        $errors = '';

        $s3config = Yii::$app->params['s3'];

        $s3 = new \Aws\S3\S3Client($s3config);
        $results = [];
        if(!$model->isNewRecord)
        {
            $user = $model->nIY;
            $sisterToken = MyHelper::getSisterToken();
            
            $sister_baseurl = Yii::$app->params['sister_baseurl'];
            $headersSister = ['content-type' => 'application/json'];
            $sisterClient = new \GuzzleHttp\Client([
                'timeout'  => 5.0,
                'headers' => $headersSister,
                // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
            ]);
            $full_url = $sister_baseurl.'/Dosen/detail';
            $responseSister = $sisterClient->post($full_url, [
                'body' => json_encode([
                    'id_token' => $sisterToken,
                    'id_dosen' => $user->sister_id
                ]), 
                'headers' => ['Content-type' => 'application/json']

            ]); 
            
           
            $responseSister = json_decode($responseSister->getBody());
            if($responseSister->error_code == 0){
                $results = $responseSister->data;
            }

            else if($response->error_code == 100){
                if(!MyHelper::wsSisterLogin()){
                    throw new \Exception("Error Creating SISTER Token", 1);
                    
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) 
        {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
           

            try 
            {
                $model->perguruan_tinggi = "Universitas Darussalam Gontor";
                $model->alamat_kampus = "Jalan Raya Siman, Ponorogo, Indonesia";
                $model->telp_kampus = "0352483762";
                $model->fax_kampus = "0352483762";
                $model->NIY = Yii::$app->user->identity->NIY;
                
                if(empty($model->bidang_ilmu_id))
                    $model->bidang_ilmu_id = null;
                
                $model->f_foto =UploadedFile::getInstance($model,'f_foto');
                
                if($model->f_foto)
                {
                    $f_foto = $model->f_foto->tempName;
                    $mime_type = $model->f_foto->type;
                    $file = 'FOTO_PROFIL_'.$model->nama.'_'.$model->NIY.'.'.$model->f_foto->extension;

                    $key = 'foto/profil/'.$file;
                    $errors = '';

                     
                    $insert = $s3->putObject([
                         'Bucket' => 'dosen',
                         'Key'    => $key,
                         'Body'   => 'This is the Body',
                         'SourceFile' => $f_foto,
                         'ContentType' => $mime_type
                    ]);

                    $plainUrl = $s3->getObjectUrl('dosen', $key);
                    $model->f_foto = $plainUrl;
                }

                if (empty($model->f_foto)){
                    // $plainUrl = $s3->getObjectUrl('siakad', $key);
                    $model->f_foto = $f_foto;
                }

                if($model->validate())
                {
                    $model->save();
                    $jenjang = MJenjangPendidikan::find()->where([
                        'kode'=>$model->jenjang_kode
                    ])->one();
                    $prodi = Prodi::findOne($model->nIY->id_prod);

                    $kode_prodi = !empty($prodi) ? $prodi->kode_prod : null;
                    $kode_fakultas = !empty($prodi) ? $prodi->id_fak : null;     
                    $dataPost = [
                        'kode_pt' => '073090',
                        'kode_fakultas' => $kode_fakultas,
                        'kode_prodi' => $kode_prodi,
                        'nik' => $model->nik,
                        'email' => $model->nIY->email,
                        'nidn' => $model->NIDN,
                        'kode_unik' => $model->kode_unik,
                        'niy' => $model->NIY,
                        'nama' => $model->nama,
                        'jenjang' => !empty($jenjang) ? $jenjang->kode_siakad : 'B',
                        'kampus' => $model->kampus,
                        'password_hash' => $model->nIY->password_hash,
                        'access_role' => 'Dosen'
                    ];
                    $response = $client->post('/siakad/d/sync', $dataPost,$headers)->send();
                    
                    $out = [];

                    
                    if ($response->isOk) {
                        $tmp = $response->data['values'];
                        if($response->data['status'] != 200)
                        {
                            $values = $response->data['values'];
                            $is_valid = false;
                            $errors .= $values['message'];
                            throw new \Exception;
                        }

                        else{


                            $transaction->commit();
                            Yii::$app->getSession()->setFlash('success','Data saved!');
                            return $this->redirect(['create']);  
                        }
                    }

                    else{

                        $errors .= 'Oops, something wrong with the API Service';
                        throw new \Exception;
                        
                    }
                    
                }

                else{
                    $errors .= \app\helpers\MyHelper::logError($model);
                    throw new \Exception;
                }
  
            } catch (\Exception $e) {
                $transaction->rollBack();
                $errors .= $e->getMessage();
                Yii::$app->getSession()->setFlash('danger',$errors);
                return $this->render('create', [
                    'model' => $model,
                    'results' => $results,
                    'listBidangIlmu' => $listBidangIlmu,
                    'listKepakaran' => $listKepakaran,
                    'listKampus' => $listKampus
                ]);
            } 
        } else {
            return $this->render('create', [
                'model' => $model,
                'results' => $results,
                'listBidangIlmu' => $listBidangIlmu,
                'listKepakaran' => $listKepakaran,
                'listKampus' => $listKampus
            ]);
        }
    }

    /**
     * Updates an existing DataDiri model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sementara = $model->f_foto;
        if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $f_foto =UploadedFile::getInstance($model,'f_foto');
            if(!empty($f_foto)){
            $NameImage = $model->nama.'-'.date('Ymd').'.'.$f_foto->extension;
            $model->f_foto = $NameImage;
            if($model->save()){
                $api_baseurl = Yii::$app->params['api_baseurl'];
                $client = new Client(['baseUrl' => $api_baseurl]);
                $client_token = Yii::$app->params['client_token'];
                $headers = ['x-access-token'=>$client_token];
                $response = $client->put('/d/update/nama', [
                    'kode_unik' => $model->kode_unik,
                    'nama_dosen' => $model->nama
                ],$headers)->send();
                if ($response->isOk) {
                    $f_foto -> saveAs('uploads/'.$model->NIY.'/'.$NameImage);
                    return $this->render('create', [
                    'model' => $model,]);    
                }
                
            }}
            $model->f_foto = $sementara;
            $model->save();
            return $this->redirect(['create', 'id' => $model->ID]);  
        }else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DataDiri model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataDiri model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataDiri the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataDiri::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
