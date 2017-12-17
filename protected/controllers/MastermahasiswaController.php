<?php

class MastermahasiswaController extends Controller
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
				'actions'=>array('index','view','templatePA'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','uploadPA'),
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

	public function actionTemplatePA()
	{
		Yii::import('ext.PHPExcel.PHPExcel');
		$objPHPExcel = new PHPExcel();

		$headers = array(
		   'Kode Dosen',
		   'Nama Dosen',
		   'NIM',
		   'Nama Mahasiswa',
		   
		);
    
	    $objPHPExcel->setActiveSheetIndex(0);

	    foreach($headers as $q => $v)
	    {
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($q,1, $v);
	    }
	    
	    $objPHPExcel->getActiveSheet()->setTitle('jadwal');
	 
	    $objPHPExcel->setActiveSheetIndex(0);
	     
	    ob_end_clean();
	    ob_start();
	    
	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="templatePA.xls"');
	    header('Cache-Control: max-age=0');
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	    $objWriter->save('php://output');
	}

	public function actionUploadPA()
	{
		$model = new Mastermahasiswa;
		$m = new Mastermahasiswa;
		if(isset($_POST['Mastermahasiswa']))
        {
			$model->uploadedFile=CUploadedFile::getInstance($model,'uploadedFile');
			Yii::import('ext.PHPExcel.PHPExcel.**', true); 

	        $fileName = $model->uploadedFile->getTempName();

	        $objPHPExcel = PHPExcel_IOFactory::load($fileName);
	        $sheet = $objPHPExcel->getSheet(0); 
	        $highestRow = $sheet->getHighestRow(); 

	        $transaction=Yii::app()->db->beginTransaction();
	        try
			{
				$index = 1;
				for ($row = 2; $row <= $highestRow; $row++)
		        {
		        	$kd_dosen = trim($sheet->getCell('A'.$row));
		        	$nim = trim($sheet->getCell('C'.$row));

		        	$attr = array(
		        		'nim_mhs' => $nim
		        	);
		        	$mhs = Mastermahasiswa::model()->findByAttributes($attr);
		        	$dosen = Masterdosen::model()->findByAttributes(array('nidn'=>$kd_dosen));
		        	if(!empty($mhs) && !empty($dosen))
		        	{
		        		echo $mhs->nim_mhs.' '.$dosen->nidn.' - '.$dosen->id;
		        		$mhs->nip_promotor = $dosen->id;
		        		$mhs->save(false, array('nip_promotor'));
		        	// print_r($kd_dosen);	
		        	}

		        	else
		        	{
		        		$m->addError('error','Baris ke-'.($index+1).' : Data NIM : '.$nim.' tidak terdaftar atau berbeda di SIAKAD');
		        		// $m->addError('error','Terjadi kesalahan input data mk');
						throw new Exception();
		        	}
		        	
		        	$index++;	 
		        }


		        Yii::app()->user->setFlash('success', "Data PA telah diunggah");
				// $this->redirect(array('uploadPA'));
		        // exit;
				$transaction->commit();
				exit;
			}

			catch(Exception $e)
			{
				$transaction->rollback();
			}	
		}

		$this->render('uploadPA',array(
			'model' => $model,
			'm' => $m,
		));
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
		$model=new Mastermahasiswa;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mastermahasiswa']))
		{
			$model->attributes=$_POST['Mastermahasiswa'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Mastermahasiswa']))
		{
			$model->attributes=$_POST['Mastermahasiswa'];
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Mastermahasiswa');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mastermahasiswa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mastermahasiswa']))
			$model->attributes=$_GET['Mastermahasiswa'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mastermahasiswa the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Mastermahasiswa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mastermahasiswa $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mastermahasiswa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
