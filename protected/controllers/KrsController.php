<?php

class KrsController extends Controller
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
				'actions'=>array('create','update','bulk'),
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

	public function actionBulk()
	{
		if(!empty($_POST['angkatan']) && !empty($_POST['semester']) && !empty($_POST['tanggal']))
		{

			$angkatan = $_POST['angkatan'];
			$semester = $_POST['semester'];
			$tanggal = $_POST['tanggal'];

			$listmhs = Yii::app()->db->createCommand()
		     ->select('*')
		    ->from('simak_mastermahasiswa')
		    ->where(array('like', 'nim_mhs', array($angkatan.'%')))
		    ->andWhere('kode_prodi=55601')
		    ->order('nim_mhs')
		    ->queryAll();

		    $bulans =  array(
		    	'01' => 'Januari',
		    	'02' => 'Februari',
		    	'03' => 'Maret',
		    	'04' => 'April',
		    	'05' => 'Mei',
		    	'06' => 'Juni',
		    	'07' => 'Juli',
		    	'08' => 'Agustus',
		    	'09' => 'September',
		    	'10' => 'Oktober',
		    	'11' => 'November',
		    	'12' => 'Desember'
		    );

		    $tgl = explode('-', $tanggal);

		    $tanggal = $tgl[0].' '.$bulans[$tgl[1]].' '.$tgl[2];

			
			// $criteria=new CDbCriteria;
			// $criteria->addSearchCondition('mahasiswa',$angkatan,true,'OR');
			// $criteria->order = 'mahasiswa ASC';
			// $listmhs = Datakrs::model()->findAll($criteria);	
		    
			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'mm', 'A4', true, 'UTF-8');

			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetAutoPageBreak(TRUE,10);
			$this->layout = '';

			date_default_timezone_set('Asia/Jakarta');
			foreach($listmhs as $m)
			{

			  	$m = (object)$m;

			  	$dosenPA = Masterdosen::model()->findByPk($m->nip_promotor);
				
				$pdf->AddPage();
				
				
				ob_start();	
				echo $this->renderPartial('print_bulk',array(
					'mhs' => $m,
					'dosenPA' => $dosenPA,
					'semester' => $semester,
					'tanggal' => $tanggal
				));
				$data = ob_get_clean();
				
				$pdf->writeHTML($data);

				// $style = array(
				//     'border' => false,
    // 				'padding' => 0,
				//     'fgcolor' => array(0,0,0),
				//     'bgcolor' => false, //array(255,255,255)
				// );
				// $pdf->write2DBarcode($m->nim_mhs.'-'.$m->nama_mahasiswa.'-'.date('Y-m-d H:i:s'), 'QRCODE,Q', 20, 200, 40, 40, $style, 'N');
			}

			ob_end_clean();
			$pdf->Output('krs_'.$angkatan.'.pdf');
			exit;
		}

		$this->render('bulk');
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
		$model=new Kampus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kampus']))
		{
			$model->attributes=$_POST['Kampus'];
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

		if(isset($_POST['Kampus']))
		{
			$model->attributes=$_POST['Kampus'];
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
		$model=new Kampus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kampus']))
			$model->attributes=$_GET['Kampus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kampus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kampus']))
			$model->attributes=$_GET['Kampus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kampus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kampus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kampus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kampus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
