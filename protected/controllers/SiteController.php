<?php

use \Firebase\JWT\JWT;

class SiteController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionLoginSso($token)
    {
    	
        $key = Yii::app()->params->jwt_key;
        $decoded = JWT::decode($token, base64_decode(strtr($key, '-_', '+/')), ['HS256']);
        // print_r($decoded);exit;
        $uuid = $decoded->uuid; // will print "1"
        $model=new User;
		$model->loginMode = 3; // SSO Mode
		$model->uuid=$uuid;
		$user = User::model()->findByAttributes(array('uuid' => $model->uuid));
		// print_r($user);exit;
		if(empty($user))
		{
			Yii::app()->user->setFlash('danger', "Tidak ada user dengan email ini");
			$this->redirect(Yii::app()->params->sso_login);
		}

		$model->username = $user->username;
		$model->password = '123';

		$result = $model->loginSso();
		// print_r($result)
		// validate user input and redirect to the previous page if valid
		switch($result)
		{
			case UserIdentity::ERROR_NONE:
				$session = Yii::app()->session;
				$session->add('token',$token);
				$time_expiration = time()+60*60*24*7; 
				$tahunaktif = Tahunakademik::model()->findByAttributes(array('buka'=> 'Y'));	
				$cookie = new CHttpCookie('tahunaktif', $tahunaktif->tahun_id);
				$cookie->expire = $time_expiration; 
				Yii::app()->request->cookies['tahunaktif'] = $cookie;	

				if(Yii::app()->user->checkAccess([WebUser::R_AKPAM,WebUser::R_TAHFIDZ, WebUser::R_ADM]))
				{
					$this->redirect(Yii::app()->createUrl('pencekalan/index'));
				}	

				else
					$this->redirect(Yii::app()->createUrl('jadwal/index'));
				
				break;
			case UserIdentity::ERROR_USERNAME_INVALID:
			case UserIdentity::ERROR_PASSWORD_INVALID:
				$this->redirect(Yii::app()->params->sso_login);
				// $model->addError('username','Incorrect username or password.');
				
				break;
			case UserIdentity::ERROR_USER_INACTIVE:
				$this->redirect(Yii::app()->params->sso_login);
				// $model->addError('username','Akun Anda belum aktif. Silakan menghubungi Administrator.');
				
				break;
		}
    }

	

	public function actionAbout()
	{
		$this->render('pages/about');
	}

	public function actionUnduh()
	{
		$this->render('unduh');
	}

	public function actionMaster()
	{
		$this->render('master');
	}

	public function actionOauth2callback()
	{
		Yii::import('ext.google.Google');
		$google = new Google();

		$google_data=$google->validate();
		$session_data=[
			'name'=>$google_data['name'],
			'email'=>$google_data['email'],
			'source'=>'google',
			'profile_pic'=>$google_data['profile_pic'],
			// 'link'=>$google_data['link'],
			'sess_logged_in'=>1
		];

		$model=new User;
		$model->loginMode = 2;
		$model->email=$google_data['email'];
		$user = User::model()->findByAttributes(array('email' => $model->email));
		// print_r($user);exit;
		if(empty($user))
		{
			Yii::app()->user->setFlash('danger', "Tidak ada user dengan email ini");
			$this->redirect(['site/login']);
		}

		$model->username = $user->username;
		$model->password = '123';

		$result = $model->loginGoogle();
		// print_r($result)
		// validate user input and redirect to the previous page if valid
		switch($result)
		{
			case UserIdentity::ERROR_NONE:
				
				$time_expiration = time()+60*60*24*7; 
				$tahunaktif = Tahunakademik::model()->findByAttributes(array('buka'=> 'Y'));	
				$cookie = new CHttpCookie('tahunaktif', $tahunaktif->tahun_id);
				$cookie->expire = $time_expiration; 
				Yii::app()->request->cookies['tahunaktif'] = $cookie;	

				if(Yii::app()->user->checkAccess([WebUser::R_AKPAM,WebUser::R_TAHFIDZ, WebUser::R_ADM]))
				{
					$this->redirect(Yii::app()->createUrl('pencekalan/index'));
				}	

				else
					$this->redirect(Yii::app()->createUrl('jadwal/index'));
				
				break;
			case UserIdentity::ERROR_USERNAME_INVALID:
			case UserIdentity::ERROR_PASSWORD_INVALID:
				$model->addError('username','Incorrect username or password.');
				
				break;
			case UserIdentity::ERROR_USER_INACTIVE:

				$model->addError('username','Akun Anda belum aktif. Silakan menghubungi Administrator.');
				
				break;
		}
		die();
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$role = Yii::app()->user->name;
		// print_r($role);exit;
		
		$this->render('home');	
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		// $this->actionLogin();
	}

	public function actionHome()
	{

		
		$this->render('home');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLoginGoogle()
	{
		if(Yii::app()->request->isAjaxRequest)
		{

			$hasil = [];
			$model=new User;
			$model->loginMode = 2;
			$model->email=$_POST['email'];
			$user = User::model()->findByAttributes(array('email' => $model->email));
			$model->username = $user->username;
			$model->password = '123';

			$result = $model->loginGoogle();
			// print_r($result)
			// validate user input and redirect to the previous page if valid
			switch($result)
			{
				case UserIdentity::ERROR_NONE:
					
					$time_expiration = time()+60*60*24*7; 
					$tahunaktif = Tahunakademik::model()->findByAttributes(array('buka'=> 'Y'));	
					$cookie = new CHttpCookie('tahunaktif', $tahunaktif->tahun_id);
					$cookie->expire = $time_expiration; 
					Yii::app()->request->cookies['tahunaktif'] = $cookie;	
					$hasil = [
						'code' => 200,
						'short' => 'success',
						'message' => 'Sukses'
					];
					break;
				case UserIdentity::ERROR_EMAIL_NOT_EXIST:
				case UserIdentity::ERROR_EMAIL_INVALID:
					
					$hasil = [
						'code' => 500,
						'short' => 'danger',
						'message' => 'Your email is invalid or not exist in our system.'
					];
					break;
				
				case UserIdentity::ERROR_USER_INACTIVE:

					$hasil = [
						'code' => 500,
						'short' => 'warning',
						'message' => 'Akun Anda belum aktif. Silakan menghubungi Administrator.'
					];
					break;
			}

			echo CJSON::encode($hasil);
		}
		
	}

	public function actionLogin()
	{
	
		$model=new User;
		$this->layout = '//layouts/main_login';
		Yii::import('ext.google.Google');
		$google = new Google();

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		
		// collect user input data
		if(isset($_POST['User']))
		{
		
			
			$model->attributes=$_POST['User'];
			$model->loginMode = 1;
			$result = $model->login();
			// validate user input and redirect to the previous page if valid
			switch($result)
			{
				case UserIdentity::ERROR_NONE:
					
					$time_expiration = time()+60*60*24*7; 
					$tahunaktif = Tahunakademik::model()->findByAttributes(array('buka'=> 'Y'));	
					$cookie = new CHttpCookie('tahunaktif', $tahunaktif->tahun_id);
					$cookie->expire = $time_expiration; 
					Yii::app()->request->cookies['tahunaktif'] = $cookie;	

					if(Yii::app()->user->checkAccess([WebUser::R_AKPAM,WebUser::R_TAHFIDZ, WebUser::R_ADM]))
					{
						$this->redirect(Yii::app()->createUrl('pencekalan/index'));
					}	

					else
						$this->redirect(Yii::app()->createUrl('jadwal/index'));
					
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$model->addError('username','Incorrect username or password.');
					
					break;
				case UserIdentity::ERROR_USER_INACTIVE:

					$model->addError('username','Akun Anda belum aktif. Silakan menghubungi Administrator.');
					
					break;
			}
			
		}
		
		
		// display the login form
		$this->render('login',array(
			'model'=>$model,
			'google_login_url' => $google->get_login_url()
		));
	}

	public function actionLogout()
	{	
		$session = Yii::app()->session;
		$session->remove('access_token','');
		$session->remove('uuid','');
		$session->destroy();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->params->sso_logout);
	}
	
}