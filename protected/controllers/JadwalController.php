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
				'actions'=>array('template','petunjuk'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','getProdi','getProdiJadwal','getDosen','cekKonflik'
				,'uploadJadwal','cetakPerDosen','cetakPersonal','rekapJadwal','exportRekap'),
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

	public function actionPetunjuk()
	{
		$this->render('petunjuk');
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

		$kelas = null;
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

		$model = new Jadwal;
		$m = new Jadwal;

		if(isset($_POST['Jadwal']))
        {

			$model->uploadedFile=CUploadedFile::getInstance($model,'uploadedFile');

			Yii::import('ext.PHPExcel.PHPExcel.**', true); 

	        $fileName = $model->uploadedFile->getTempName();

	        $objPHPExcel = PHPExcel_IOFactory::load($fileName);
	        $sheet = $objPHPExcel->getSheet(0); 
	        $highestRow = $sheet->getHighestRow(); 
	        // $highestColumn = $sheet->getHighestColumn();
	        // $highestColumn++;
	        // print_r($highestColumn);
	        //Loop through each row of the worksheet in turn

	        $transaction=Yii::app()->db->beginTransaction();
	        try
			{
				$index = 0;
		        for ($row = 2; $row <= $highestRow; $row++)
		        { 


		        	$hari = strtoupper($sheet->getCell('A'.$row));
		        	$jam_ke = $sheet->getCell('B'.$row);

		        	$jam = Jam::model()->findByAttributes(array('nama_jam'=>$jam_ke));

		        	if(empty($jam))
		        	{
		        		$m->addError('error','Baris ke-'.($index+1).' : Format Jam Salah atau data jam tidak ada');
						throw new Exception();
		        	}
		        		

		        	$waktu = $sheet->getCell('C'.$row);
		        	$waktu = explode('-', $waktu);
		        	if(count($waktu) != 2)
		        	{
		        		$m->addError('error','Baris ke-'.($index+1).' : Format Waktu Salah');
						throw new Exception();
		        	}

		        	$jam_mulai = $waktu[0];


		        	$jam_selesai = $waktu[1];
		        	// echo $id_jam_ke;
		        	$kode_mk = $sheet->getCell('D'.$row);
		        	$nama_mk = $sheet->getCell('E'.$row);
		        	$kode_dosen = $sheet->getCell('F'.$row);
		        	$nama_dosen = $sheet->getCell('G'.$row);
		        	$kd_ruangan = $sheet->getCell('H'.$row);
		        	$fakultas = $sheet->getCell('I'.$row);
		        	$nama_fakultas = $sheet->getCell('J'.$row);
		        	$prodi = $sheet->getCell('K'.$row);
		        	$nama_prodi = $sheet->getCell('L'.$row);
		        	$tahun_akademik = $sheet->getCell('M'.$row);
		        	$semester = $sheet->getCell('N'.$row);
		        	$kampus = $sheet->getCell('O'.$row);
		        	$id_kampus = Kampus::model()->findByAttributes(array('nama_kampus'=>$kampus));
		        	$id_kampus = !empty($id_kampus) ? $id_kampus->id : '';

		        	if(empty($id_kampus))
		        	{
		        		$m->addError('error','Baris ke-'.($index+1).' : Nama kampus Salah atau data tidak ada');
						throw new Exception();
		        	}

		        	// $sks = $sheet->getCell('P'.$row);
		        	$kelas = $sheet->getCell('P'.$row);
		        	$id_kelas = Masterkelas::model()->findByAttributes(array('nama_kelas'=>$kelas));
		        	$id_kelas = !empty($id_kelas) ? $id_kelas->id : '';

		        	if(empty($id_kelas))
		        	{
		        		$m->addError('error','Baris ke-'.($index+1).' : Nama Kelas Salah atau data tidak ada');
						throw new Exception();
		        	}


		        	$m = new Jadwal;	
					$m->hari = $hari;

					$m->jam_ke = $jam->id_jam;
					$m->jam = $jam_mulai.'-'.$jam_selesai;
					$m->jam_mulai = $jam_mulai;
					$m->jam_selesai = $jam_selesai;
					
					$m->kode_mk = $kode_mk;
					$m->nama_mk = $nama_mk;
					$m->kode_dosen = $kode_dosen;
					$m->nama_dosen = $nama_dosen;
					$m->semester = $semester;
					$m->kelas = $id_kelas;
					
					$m->fakultas = $fakultas;
					$m->nama_fakultas = $nama_fakultas;
					$m->prodi = $prodi;
					$m->nama_prodi = $nama_prodi;
					$m->kd_ruangan = $kd_ruangan;
					$m->tahun_akademik = $tahun_akademik;
					
					$m->kuota_kelas = 40;
					$m->kampus = $id_kampus;
					// echo $id_kampus;
					// $m->sks = $sks;

					if($m->validate())
					{

						$m->save();
					}

					else
					{
						$errors .= 'Baris ke-';
						$errors .= ($index + 1).' : ';
						
						foreach($m->getErrors() as $attribute){
							foreach($attribute as $error){
								$errors .= $error.' ';
							}
						}
						
						$m->addError('error',$errors);
						throw new Exception();
					}
					
					$index++;
		        }

		        // $this->redirect(array('trRawatInap/lainnya','id'=>$id));
		        $transaction->commit();
	        }

			catch(Exception $e){
				// Yii::app()->user->setFlash('error', print_r($e->errorInfo));
				$transaction->rollback();
			}	
	    }


		$this->render('upload_jadwal',array(
			'model' => $model,
			'm' => $m

		));

	}

	public function actionTemplate()
	{
		Yii::import('ext.PHPExcel.PHPExcel');
		$objPHPExcel = new PHPExcel();

		$headers = array(
			'Hari',
		   'Jam',
		   'Waktu',
		   'KD MK',
		   'Mata Kuliah',
		   'NIY',
		   'Dosen Pengampu',
		   'RUANG',
		   'KD FT',
		   'FAKULTAS',
		   'KD PRODI',
		   'PRODI',
		   'TAHUN',
		   'Semester ',
		   'Kampus',
		   // 'SKS',
		   'Kelas',
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
	    header('Content-Disposition: attachment;filename="template.xls"');
	    header('Cache-Control: max-age=0');
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	    $objWriter->save('php://output');
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
	            $list = CHtml::listData($prodis, 'kode_prodi', 'singkatan');    

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
