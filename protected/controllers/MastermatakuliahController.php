<?php

class MastermatakuliahController extends Controller
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
				'actions'=>array('create','update','ajaxSync','ajaxSave'),
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

	public function actionAjaxSave()
	{
		$kode_mk = $_POST['kode_mk'];
		$prodi = $_POST['prodi'];
		$tahun = $_POST['tahun'];
		$nama_en = $_POST['nama_en'];
		
		$mk = Mastermatakuliah::model()->findByAttributes([
			'kode_mata_kuliah' => $kode_mk,
			'kode_prodi' => $prodi,
			'tahun_akademik' => $tahun
		]);
		$results = [];
		if(!empty($mk))
		{
			$mk->nama_mata_kuliah_en = trim($nama_en);
			$mk->save(false,['nama_mata_kuliah_en']);
			$results = [
				'code' => 200,
				'msg' => '<div class="label label-success">Saved</div>'
			];
		}

		else{
			$results = [
				'code' => 500,
				'msg' => '<div class="label label-danger">Something wrong</div>'
			];
		}

		

		echo json_encode($results);
	}

	public function actionAjaxSync()
	{
		$kode_mk = $_POST['kode_mk'];
		
		$results = [];
		$params = [
			'table'		=> 'mata_kuliah',
			'filter' 	=> 'kode_mk = \''.$kode_mk.'\'',
		];

		$host = Yii::app()->rest->baseurl_apigateway;
		

		$url = $host."/feeder/record";

		$hasil = null;

		$api = new RestClient;
		$headers = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];


		$result = $api->post($url, $params, $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}

		$results['hasil'] = $hasil;
		
		if(!empty($hasil->values->output->result->id_mk)){
			$hsl = (array) $hasil->values->output->result->id_mk;
			$id_mk = $hsl['$value'];
			$list_mk = Mastermatakuliah::model()->findAllByAttributes(['kode_mata_kuliah'=>$kode_mk]);
			foreach($list_mk as $m)
			{
				$m->kode_feeder = $id_mk;
				$m->save();
			}
			
			$results['value'] = $hsl['$value'];

			// $m->kode_pd = $id_pd;
			// $m->save();
			// $prodi = Masterprogramstudi::model()->findByAttributes(['kode_prodi'=> $m->kode_prodi]);

			// $params = [
			// 	'id_pd'		=> $id_pd,
			// 	'id_sp' 	=> '715253d2-bafa-429a-9ff7-a85b34ff955d',
			// 	'nipd' 			=> $m->nim_mhs,
			// 	'tgl_masuk_sp' => $_POST['tgl_masuk'],
			// 	'id_jns_daftar' => 1,
			// 	'mulai_smt'	=> $_POST['ta_masuk'],
			// 	'id_sms' => $prodi->kode_feeder,				
			// ];

			// $url = $host."/feeder/m/insert/pt";

			// $hasil = null;

			// $api = new RestClient;

			// $result = $api->post($url, $params, $headers);
			
			// try{
				
			// 	$hasil = $result->decode_response();
			// }

			// catch(RestClientException  $e){
			// 	//print_r($e);
			// 	//throw new RestClientException;
			// 	$hasil = null;
			// }
		}

		echo json_encode($results);
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
		$model=new Mastermatakuliah;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mastermatakuliah']))
		{
			$model->attributes=$_POST['Mastermatakuliah'];
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

		if(isset($_POST['Mastermatakuliah']))
		{
			$model->attributes=$_POST['Mastermatakuliah'];
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
	public function actionIndex($kode_prodi='', $tahun_akademik = '')
	{

		$model = new Mastermatakuliah;
		$list_matkul = [];
		if(!empty($_GET['kode_prodi']) && !empty($_GET['tahun_akademik']))
		{
			$c = new CDbCriteria;
			$c->condition = 'kode_prodi = :p1 AND tahun_akademik = :p2';
			$c->params = [
				':p1' => $_GET['kode_prodi'],
				':p2' => $_GET['tahun_akademik'],
			
			];
			$c->order = 'nama_mata_kuliah ASC';
			$list_matkul = Mastermatakuliah::model()->findAll($c);
			// $mahasiswas = Mastermahasiswa::model()->findAllByAttributes([
			// 	'kode_prodi' => $_GET['kode_prodi'],
			// 	'kampus' => $_GET['kampus']
			// ],['order' => 'nim_mhs DESC']);

			
		}


		$this->render('index',[
			'model'=>$model,
			'list_matkul' => $list_matkul
		]);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mastermatakuliah('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['filter']))
			$model->SEARCH=$_GET['filter'];

		if(isset($_GET['size']))
			$model->PAGE_SIZE=$_GET['size'];
		
		if(isset($_GET['Mastermatakuliah']))
			$model->attributes=$_GET['Mastermatakuliah'];

		$this->render('admin',[
			'model'=>$model,
		]);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mastermatakuliah the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Mastermatakuliah::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mastermatakuliah $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mastermatakuliah-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
