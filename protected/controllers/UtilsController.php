<?php

class UtilsController extends Controller
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('foto','test','ttd','ajaxSaveTtd'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAjaxSaveTtd()
	{
		$setting = Settings::model()->findByAttributes(['name'=>'site.ttd']);
		
		$data = $_POST['dataItem'];
		$data_uri = $data['signature'];
		$encoded_image = explode(",", $data_uri)[1];
		$setting->value = $encoded_image;
		
		if(!$setting->save()){
			print_r($setting->getErrors());exit;
		}

		
	}

	public function actionTtd()
	{
		$setting = Settings::model()->findByAttributes(['name'=>'site.ttd']);
		if(empty($setting))
		{
			$setting = new Settings;
			$setting->module = 'core';
			$setting->name = 'site.ttd';
			$setting->save();
		}


		$this->render('ttd',[
			'model' => $setting
		]);
	}

	public function actionTest(){
		$file = $_FILES['image']['tmp_name'];
		$model = new KartuForm;
		$model->uploadedFile=$_FILES;
		move_uploaded_file( $_FILES['image']['tmp_name'], Yii::app()->baseUrl.'images/fotoku.jpg');
		// $model->uploadedFile->saveAs(Yii::app()->baseUrl.'/images/fotoku.jpg');
		print_r($model->uploadedFile);
		exit;
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionFoto($snap = 0)
	{
		$model = new KartuForm;
		if(!empty($_POST['KartuForm']))
		{
			$model->uploadedFile=CUploadedFile::getInstance($model,'uploadedFile');
			echo 'a' ;
			print_r($model->uploadedFile);
	        // $fileName = $model->uploadedFile->getTempName();

	        // print_r($fileName);
			// header('Content-type: images/jpeg' );
			// $img = $_POST['gb'];
			// $img = str_replace('data:image/png;base64,', '', $img);
			// $img = str_replace(' ', '+', $img);
			// $data = base64_decode($img);
			// $file = 'image.png';
			// $success = file_put_contents($file, $data);
			// imagejpeg($data);
			exit;
			// try
			// {

			// 	ob_start();
			// 	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf',
   //                          'L', 'mm', 'A7', true, 'UTF-8');

			// 	$pdf->setPrintHeader(false);
			// 	$pdf->setPrintFooter(false);
			// 	$page_format = array(
			// 	    'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 53.98, 'ury' => 85.60),


			// 	);

			// 	$pdf->AddPage('L', $page_format, false, false);
			// 	$pdf->SetAutoPageBreak(TRUE, 0);

			// 	$pdf->write1DBarcode('Test','C128',52.5,43.5,100,7);

			// 	$pdf->SetFont('helvetica', '', 8.5);
			// 	$pdf->Text(5,26.5,'No.RM');
			// 	$pdf->Text(16,26.5,':');
			// 	$pdf->Text(5,32.3,'Nama');
			// 	$pdf->Text(16,32.3,':');
			// 	$pdf->Text(18.5,32.3,'AAA');
			// 	$pdf->Text(5,38.3,'Alamat');
			// 	$pdf->Text(16,38.3,':');
			// 	$pdf->Text(18.5,38.3,'BBB');

			// 	$pdf->SetFont('helvetica', 'B', 14);
			// 	$pdf->Text(18.5,24.7,'AA');


			// 	$pdf->Output("ktm.pdf", "I");

			// }
			// catch(HTML2PDF_exception $e) {
			//     echo $e;
			//     exit;
			// }
		}
		
		$this->render('foto',array(
			'model' => $model
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Jam the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Jam::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Jam $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='jam-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
