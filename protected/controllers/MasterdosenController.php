<?php

class MasterdosenController extends Controller
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
				'actions'=>array('create','update','unduhDataDosen'),
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


	public function actionUnduhDataDosen()
	{
		Yii::import('ext.PHPExcel.PHPExcel');
		$objPHPExcel = new PHPExcel();
		$styleArray = array(
		    'font'  => array(
		        // 'bold'  => true,
		        // 'color' => array('rgb' => 'FF0000'),
		        'size'  => 8,
		        'name'  => 'Times New Roman'
		    ),
		    'borders' => array(
		    	'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN,
	                'color' => array('rgb' => '000000')
	            )
		    )

		);
		$headers = array(
		   'No',
		   'Kode Dosen',
		   'NIY',
		   'Nama Dosen',
		  	
		);
    
	    $objPHPExcel->setActiveSheetIndex(0);

	    foreach($headers as $q => $v)
	    {
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($q,1, $v);
	    }
	    
	    $objPHPExcel->getActiveSheet()->setTitle('dosen');
	 
	    $objPHPExcel->setActiveSheetIndex(0);
	    $objPHPExcel->getActiveSheet()->freezePane('E2');
	    $sheet = $objPHPExcel->setActiveSheetIndex(0);

	    $sheet->getColumnDimension('A')->setWidth(5);
	    $sheet->getColumnDimension('B')->setWidth(20);
	    $sheet->getColumnDimension('C')->setWidth(16);
	    $sheet->getColumnDimension('D')->setWidth(42);


	    $dosen = Masterdosen::model()->findAll();
	    

	    foreach($headers as $q => $v)
	    {
	    	$sheet->setCellValueByColumnAndRow($q,1, strtoupper($v));
	    	$cell = $sheet->getCellByColumnAndRow($q,1);
	    	$cell->getStyle($cell->getColumn().$cell->getRow())->applyFromArray(
	    		array(
	    			'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '000000')
			        ),
			        'font' => array(
			        	'color' => array('rgb'=> 'ffffff')
			        ),
	    		)
	    	);
	    	
	    }

	    $i = 0;
	    $row = 1;
	    foreach($dosen as $d)
	    {
	    	$i++;
	    	$row++;
	    	$sheet->setCellValueByColumnAndRow(0,$row, $i);
			$sheet->setCellValueByColumnAndRow(1,$row, $d->nidn);
			$sheet->setCellValueByColumnAndRow(2,$row, $d->niy);
			$sheet->setCellValueByColumnAndRow(3,$row, strtoupper($d->nama_dosen));
	    	
	    	for($j = 0;$j<4;$j++)
	    	{
	    		$cell = $sheet->getCellByColumnAndRow($j,$row);	
	    		$cell->getStyle($cell->getColumn().$cell->getRow())
	    		->getNumberFormat()
    			->setFormatCode(
			        PHPExcel_Style_NumberFormat::FORMAT_TEXT
			    );
	    	}
	    	
	    	
	    }
	     
	    ob_end_clean();
	    ob_start();
	    
	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="templatePA.xls"');
	    header('Cache-Control: max-age=0');
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	    $objWriter->save('php://output');
	    
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
		$model=new Masterdosen;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Masterdosen']))
		{
			$model->attributes=$_POST['Masterdosen'];
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

		if(isset($_POST['Masterdosen']))
		{
			$model->attributes=$_POST['Masterdosen'];
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
		$dataProvider=new CActiveDataProvider('Masterdosen');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Masterdosen('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['filter']))
			$model->SEARCH=$_GET['filter'];

		if(isset($_GET['size']))
			$model->PAGE_SIZE=$_GET['size'];

		if(isset($_GET['kode_prodi']))
			$model->kode_prodi=$_GET['kode_prodi'];

		if(isset($_GET['Masterdosen']))
			$model->attributes=$_GET['Masterdosen'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Masterdosen the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Masterdosen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Masterdosen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='masterdosen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
