<?php

class DatakrsController extends Controller
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
		return [
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		];
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return [
			['allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			],
			['allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
			],
			['allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			],
			['deny',  // deny all users
				'users'=>array('*'),
			],
		];
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',[
			'model'=>$this->loadModel($id),
		]);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Datakrs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Datakrs']))
		{
			$model->attributes=$_POST['Datakrs'];
			if($model->save()){
				Yii::app()->user->setFlash('success', "Data telah tersimpan.");
				$this->redirect(['index']);
			}
		}

		$this->render('create',[
			'model'=>$model,
		]);
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

		if(isset($_POST['Datakrs']))
		{
			$model->attributes=$_POST['Datakrs'];
			if($model->save()){
				Yii::app()->user->setFlash('success', "Data telah tersimpan.");
				$this->redirect(['index']);
			}
		}

		$this->render('update',[
			'model'=>$model,
		]);
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
	public function actionIndex()
	{
		$model=new Datakrs('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['filter']))
			$model->SEARCH=$_GET['filter'];

		if(isset($_GET['size']))
			$model->PAGE_SIZE=$_GET['size'];
		
		if(isset($_GET['Datakrs']))
			$model->attributes=$_GET['Datakrs'];

		$this->render('index',[
			'model'=>$model,
		]);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Datakrs('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['filter']))
			$model->SEARCH=$_GET['filter'];

		if(isset($_GET['size']))
			$model->PAGE_SIZE=$_GET['size'];
		
		if(isset($_GET['Datakrs']))
			$model->attributes=$_GET['Datakrs'];

		$this->render('admin',[
			'model'=>$model,
		]);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Datakrs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Datakrs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Datakrs $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='datakrs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
