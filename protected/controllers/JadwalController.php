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
				'actions'=>array('create','update','index','view','getProdi','getProdiJadwal','getDosen','cekKonflik','template','uploadJadwal','cetakPerDosen','cetakPersonal','rekapJadwal','exportRekap'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
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

	public function actionExportRekap($id)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));

		$criteria=new CDbCriteria;
		$criteria->compare('prodi',$id);
		$criteria->order = 'semester DESC';
		$model = Jadwal::model()->findAll($criteria);	
		
		echo $this->renderPartial('rekap_jadwal_xls',array(
			'model' => $model,
			'tahun_akademik' => $tahun_akademik
		));
	}

	public function actionRekapJadwal()
	{
		$models = array();

		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));

		if(!empty($_POST['kode_prodi']))
		{
			$criteria=new CDbCriteria;
			$criteria->order = 'nama_kelas ASC';
			
			$kelas = Masterkelas::model()->findAll($criteria);

			foreach($kelas as $k)
			{
				$m = Jadwal::model()->findRekapJadwal($_POST['kode_prodi'], $k->id);
				if(!empty($m))
					$models[] = $m;
			}



		}

		

		$this->render('rekap_jadwal',array(
			'models' => $models,
			'kelas' => $kelas,
			'tahun_akademik' => $tahun_akademik

		));
	}

	public function actionCetakPersonal($id)
	{
		$model = Jadwal::model()->findAllByAttributes(array('kode_dosen'=>$id));
		$dosen = Masterdosen::model()->findByAttributes(array('niy'=>$id));

		
		$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                'L', 'mm', 'A4', true, 'UTF-8');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(TRUE,10);
		$pdf->AddPage();
		
		$this->layout = '';
		ob_start();
		//echo $this->renderPartial(“createnewpdf“,array(‘content’=>$content));
		
		echo $this->renderPartial('print_jadwalpersonal',array(
			'model'=>$model,
			'dosen' => $dosen
		));

		$data = ob_get_clean();
		ob_start();
		$pdf->writeHTML($data);

		$pdf->Output();
		
	}

	public function actionCetakPerDosen()
	{

		$model = null;
		$dosen = null;
		if(!empty($_POST['kode_dosen']))
		{
			$model = Jadwal::model()->findAllByAttributes(array('kode_dosen'=>$_POST['kode_dosen']));
			$dosen = Masterdosen::model()->findByAttributes(array('niy'=>$_POST['kode_dosen']));

			
		}



		$this->render('preview_perdosen',array(
			'model' => $model,
			'dosen' => $dosen

		));
	}

	public function actionUploadJadwal()
	{

	}

	public function actionTemplate()
	{
		header('Content-type: application/excel');
		$filename = 'template_jadwal.xls';
		header('Content-Disposition: attachment; filename='.$filename);

		$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
		<head>
		    <!--[if gte mso 9]>
		    <xml>
		        <x:ExcelWorkbook>
		            <x:ExcelWorksheets>
		                <x:ExcelWorksheet>
		                    <x:Name>Sheet 1</x:Name>
		                    <x:WorksheetOptions>
		                        <x:Print>
		                            <x:ValidPrinterInfo/>
		                        </x:Print>
		                    </x:WorksheetOptions>
		                </x:ExcelWorksheet>
		            </x:ExcelWorksheets>
		        </x:ExcelWorkbook>
		    </xml>
		    <![endif]-->
		</head>

		<body>
		   <table>
		   <tr>
		   <td>Hari (huruf kapital semua)</td>
		   <td>Jam (format angka)</td>
		   <td>Waktu (awal-akhir. Contoh : 07:30-09:10)</td>
		   <td>KD MK</td>
		   <td>Mata Kuliah</td>
		   <td>KD (Kode dosen)</td>
		   <td>NIDN/NIY</td>
		   <td>Dosen Pengampu</td>
		   <td>RUANG</td>
		   <td>KD FT</td>
		   <td>FAKULTAS</td>
		   <td>KD PRODI</td>
		   <td>PRODI</td>
		   <td>TAHUN (contoh format : 2017-2018)</td>
		   <td>Semester (format angka. Contoh: 6</td>
		   <td>Kampus (Hanya dari daftar berikut : {SIMAN, MANTINGAN, GONTOR, KEDIRI, KANDANGAN, MAGELANG})</td>
		   <td>SKS</td>
		   <td>Kelas</td>
			</tr>
		   </table>
		</body></html>';

		echo $data;
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

			$criteria->limit = 10;

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
	                'order' => 'nama_mata_kuliah ASC',
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
			$model->jam = $model->jam_mulai;
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
