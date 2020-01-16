<?php

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
		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('site/index'));
	}
	
}