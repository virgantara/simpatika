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
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','test','publikasi','jurnal','buku','konferensi','hki','lain','profil-dosen'],
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
     * Declares external actions for the controller.
     *
     * @return array
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
            
            Yii::$app->user->login($user);
            
            return $this->redirect(['site/index']);
        }

        else{
            
            
            return $this->redirect(Yii::$app->params['sso_login'].'/site/sso-callback?code=302')->send();
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
      
        return $this->render('index',[
            
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
