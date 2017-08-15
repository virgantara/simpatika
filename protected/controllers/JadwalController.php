<?php

class JadwalController extends Controller
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
				'actions'=>array('index','view','getProdi','getProdiJadwal','getDosen','cekKonflik'),
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

	public function actionCekKonflik()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			$kampus = Yii::app()->request->getPost('k');
			$hari = Yii::app()->request->getPost('h');
			$ja = Yii::app()->request->getPost('ja'); 
			$js = Yii::app()->request->getPost('js');

			$attr = array(
				'kampus' => $kampus,
				'hari' => $hari,
				// 'jam_mulai' => $ja,
				// 'jam_selesai' => $js
			);
			$models = Jadwal::model()->findAllByAttributes($attr);
			
			$hasil = array(
				'code' => 1,
				'msg' => 'Empty'
			);

			if(!empty($models))
			{

				foreach($models as $model)
				{
					$current_time = $ja;
					$curr = DateTime::createFromFormat('H:i:s', $current_time);
					$timestart = DateTime::createFromFormat('H:i:s', $model->jam_mulai);
					$timeend = DateTime::createFromFormat('H:i:s', $model->jam_selesai);
					if ($curr > $timestart && $curr < $timeend)
					{
					   
						$hasil = array(
							'code' => 2,
							'msg' => 'Jadwal Pada Jam Ini Sudah Ada.'
						);
								   

					   break;
					}
				}
				
			}

			echo CJSON::encode($hasil);

			

		}
	}

	public function actionGetDosen()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			
			$q = $_GET['term'];
			$criteria=new CDbCriteria;
			$criteria->addSearchCondition('nama_dosen',$q,true,'OR');

			$criteria->limit = 20;

			$model = Masterdosen::model()->findAll($criteria);

			$result = array();
			foreach($model as $m)
			{

				$result[] = array(
					'id' => $m->niy,
					'value' => $m->nama_dosen,

				);
			}


	        echo CJSON::encode($result);
		}
	}

	public function actionGetProdiJadwal()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			
			$cid = Yii::app()->request->getPost('q'); 

			$tahunaktif = Yii::app()->request->cookies['tahunaktif']->value;

			$matkul= Mastermatakuliah::model()->findAll(
	                array(
	               'condition'=>'kode_prodi=:cid and tahun_akademik=:thn', 
	               'params'=>array(
	               		':cid'=>$cid,
	               		':thn' => $tahunaktif
	               	)));
	        $list = CHtml::listData($matkul, 'kode_mata_kuliah', 'nama_mata_kuliah');    

	        // print_r($list);exit;

	        echo json_encode($list);
		}
	}

	public function actionGetProdi()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			
			$cid = Yii::app()->request->getPost('q'); 

			$prodis= Masterprogramstudi::model()->findAll(
	                array(
	               'condition'=>'kode_fakultas=:cid', 
	               'params'=>array(':cid'=>$cid)));
	            $list = CHtml::listData($prodis, 'kode_prodi', 'nama_prodi');    

	        echo json_encode($list);
		}
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
	public function actionCreate()
	{
		$model=new Jadwal;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Jadwal']))
		{
			$model->attributes=$_POST['Jadwal'];
			$model->nama_dosen = $_POST['nama_dosen'];
			$fak = Masterfakultas::model()->findByAttributes(array('kode_fakultas'=> $model->fakultas));
			$prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=> $model->prodi));
			$mk = Mastermatakuliah::model()->findByAttributes(array('kode_mata_kuliah'=> $model->kode_mk));

			$model->nama_fakultas = $fak->nama_fakultas;
			$model->nama_prodi = $prodi->nama_prodi;
			$model->nama_mk = $mk->nama_mata_kuliah;
			if($model->save()){

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Jadwal']))
		{
			$model->attributes=$_POST['Jadwal'];
			$model->nama_dosen = $_POST['nama_dosen'];

			$fak = Masterfakultas::model()->findByAttributes(array('kode_fakultas'=> $model->fakultas));
			$prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=> $model->prodi));
			$mk = Mastermatakuliah::model()->findByAttributes(array('kode_mata_kuliah'=> $model->kode_mk));

			$model->nama_fakultas = $fak->nama_fakultas;
			$model->nama_prodi = $prodi->nama_prodi;
			$model->nama_mk = $mk->nama_mata_kuliah;
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
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
	public function actionIndex()
	{
		$model=new Jadwal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Jadwal']))
			$model->attributes=$_GET['Jadwal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Jadwal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Jadwal']))
			$model->attributes=$_GET['Jadwal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Jadwal the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Jadwal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Jadwal $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='jadwal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
