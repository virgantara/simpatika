<?php

class PencekalanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column_cekal';

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
				'actions'=>array('create','update','postdata','simpanCekalAkademik','akademik'),
				'users'=>array('@'),
			],
			['allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			],
			['deny',  // deny all users
				'users'=>array('*'),
			],
		];
	}

	public function actionSimpanCekalAkademik()
	{
		if(!empty($_POST['btn-simpan']))
		{
			$tahun_akademik = SimakTahunakademik::model()->findByAttributes(array('buka'=>'Y'));
			$tahunaktif = $tahun_akademik->tahun_id;
				
			$url = "/mk/list/mhs";
			$params = [
				'tahun' => $tahun_akademik->tahun_id,
				'prodi' => $_POST['kode_prodi'],
				'kampus' => $_POST['kampus'],
				'kode_mk' => $_POST['kode_mk'],
				'jid' => $_POST['jid']
			];
				
			$result = Yii::app()->rest->getDataApi($url,$params);

			$results = $result->values;
			// print_r($params);exit;
			foreach($results as $item)
			{
				$krs = Datakrs::model()->findByPk($item->id);
				$krs->is_tercekal = 0;
				$krs->keterangan_tercekal = '';

				if(!empty($_POST['akademik_'.$item->id]))
				{

					$krs->is_tercekal = 1;
					$krs->keterangan_tercekal = !empty($_POST['keterangan_tercekal_'.$item->id]) ? $_POST['keterangan_tercekal_'.$item->id] : '';
					
				}

				$krs->save(false,['is_tercekal','keterangan_tercekal']);
			}

			Yii::app()->user->setFlash('success', 'Data tersimpan');	
			$this->redirect(['pencekalan/akademik','kampus'=>$_POST['kampus'],'kode_prodi'=>$_POST['kode_prodi'],'kode_mk'=>$_POST['kode_mk'],'semester'=>$_POST['semester'],'jid'=>$_POST['jid'],'btn-lihat'=>1]);
		}
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
		$model=new Pencekalan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pencekalan']))
		{
			$model->attributes=$_POST['Pencekalan'];
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

		if(isset($_POST['Pencekalan']))
		{
			$model->attributes=$_POST['Pencekalan'];
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

	public function actionPostdata()
	{
		$tahun_akademik = SimakTahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;


		if(!empty($_POST['btn-simpan']))
		{
			$results = Pencekalan::getListMahasiswa($_POST['kampus'],$_POST['kode_prodi']);
				// print_r($_POST);exit;
			foreach($results as $item)
			{
				$p = Pencekalan::model()->findByAttributes([
					'tahun_id' => $tahunaktif,
					'nim' => $item->nim_mhs
				]);

				if(empty($p))
					$p = new Pencekalan;

				// print_r($_POST);exit;
				$p->tahfidz = !empty($_POST['tahfidz_'.$tahunaktif.'_'.$item->nim_mhs]) ? 1 : 0;
				$p->akpam = !empty($_POST['akpam_'.$tahunaktif.'_'.$item->nim_mhs]) ? 1 : 0;
				// $p->adm = !empty($_POST['adm_'.$tahunaktif.'_'.$item->nim_mhs]) ? 1 : 0;
				$p->akademik = !empty($_POST['akademik_'.$tahunaktif.'_'.$item->nim_mhs]) ? 1 : 0;
				$p->nim = $item->nim_mhs;
				$p->tahun_id = $tahunaktif;

				$p->save();
			}

			Yii::app()->user->setFlash('success', 'Data tersimpan');	
			$this->redirect(['index']);
		}


		
	}

	public function actionAkademik()
	{
		$results = [];
		$tahun_akademik = SimakTahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		if(!empty($_GET['btn-lihat']))
		{
			
			$url = "/mk/list/mhs";
			$params = [
				'tahun' => $tahun_akademik->tahun_id,
				'prodi' => $_GET['kode_prodi'],
				'kampus' => $_GET['kampus'],
				'kode_mk' => $_GET['kode_mk'],
				'jid' => $_GET['jid']
			];
				
			$result = Yii::app()->rest->getDataApi($url,$params);

			$results = $result->values;
			// print_r($results);exit;
		}

		
		$this->render('akademik',[
			'results'=>$results,
			'tahunaktif' => $tahunaktif
		]);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$results = [];
		$tahun_akademik = SimakTahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		if(!empty($_GET['btn-lihat']))
		{
			$results = Pencekalan::getListMahasiswa($_GET['kampus'],$_GET['kode_prodi']);

			
		}

		
		$this->render('index',[
			'results'=>$results,
			'tahunaktif' => $tahunaktif
		]);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pencekalan('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['filter']))
			$model->SEARCH=$_GET['filter'];

		if(isset($_GET['size']))
			$model->PAGE_SIZE=$_GET['size'];
		
		if(isset($_GET['Pencekalan']))
			$model->attributes=$_GET['Pencekalan'];

		$this->render('admin',[
			'model'=>$model,
		]);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pencekalan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pencekalan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pencekalan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pencekalan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
