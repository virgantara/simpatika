<?php

class MahasiswaOrtuController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($kode_prodi, $kampus, $ta_masuk,$tgl_masuk, $nim)
	{
		$model=new MahasiswaOrtu;

		$model->nim = $nim;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MahasiswaOrtu']))
		{
			$model->attributes=$_POST['MahasiswaOrtu'];
			if($model->save()){
				Yii::app()->user->setFlash('success', "Data Saved.");
				$this->redirect([
					'mastermahasiswa/dataortu',
					'kode_prodi'=>$_POST['kode_prodi'],
					'kampus' => $_POST['kampus'],
					'ta_masuk' => $_POST['ta_masuk'],
					'tgl_masuk' => $_POST['tgl_masuk']
				]);
			}
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => 51],['order'=>'kode_feeder']);

		$list_agama = [];
		foreach($tmp as $v)
		{
			$list_agama[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '01'],['order'=>'kode_feeder']);

		$list_pendidikan = [];
		foreach($tmp as $v)
		{
			$list_pendidikan[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '55'],['order'=>'kode_feeder']);

		$list_pekerjaan = [];
		foreach($tmp as $v)
		{
			$list_pekerjaan[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '69'],['order'=>'kode_feeder']);

		$list_penghasilan = [];
		foreach($tmp as $v)
		{
			$list_penghasilan[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '53'],['order'=>'kode_feeder']);

		$list_keadaan = [];
		foreach($tmp as $v)
		{
			$list_keadaan[$v->value] = $v->label;
		}

		$this->render('create',array(
			'model'=>$model,
			'list_agama' => $list_agama,
			'list_pendidikan' => $list_pendidikan,
			'list_pekerjaan'=>$list_pekerjaan,
			'list_penghasilan' => $list_penghasilan,
			'list_keadaan' => $list_keadaan,
			'kampus' => $kampus,
			'kode_prodi' => $kode_prodi,
			'tahun_angkatan' => $tahun_angkatan
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MahasiswaOrtu']))
		{
			$model->attributes=$_POST['MahasiswaOrtu'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($nim)
	{
		$dataProvider=new CActiveDataProvider('MahasiswaOrtu');

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($nim)
	{

		$this->layout = '//layouts/lite';

		$model=new MahasiswaOrtu('search');
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MahasiswaOrtu']))
			$model->attributes=$_GET['MahasiswaOrtu'];

		$model->nim = $nim;
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MahasiswaOrtu the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MahasiswaOrtu::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MahasiswaOrtu $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mahasiswa-ortu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
