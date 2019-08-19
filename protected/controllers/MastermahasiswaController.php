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
				'actions'=>array('create','update','uploadPA','ortu','dataortu','updatebio','ajaxFindWilayah','ajaxFindWilayahOne','ajaxFindNegara','uploadMhs','ajaxSync'),
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

	public function actionAjaxSync()
	{
		$nim = $_POST['nim'];
		$m = Mastermahasiswa::model()->findByAttributes(['nim_mhs'=>$nim]);
		$ayah = MahasiswaOrtu::model()->findByAttributes([
			'hubungan'=> 'AYAH',
			'nim' => $nim
		]);

		$ibu = MahasiswaOrtu::model()->findByAttributes([
			'hubungan'=> 'IBU',
			'nim' => $nim
		]);

		$wali = MahasiswaOrtu::model()->findByAttributes([
			'hubungan'=> 'WALI',
			'nim' => $nim
		]);

		
		$host = Yii::app()->rest->baseurl_apigateway;
		

		$api = new RestClient;
		$headers = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$url = $host."/feeder/record";

		$hasil = null;

		$api = new RestClient;
		$headers = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$params = [
			'table'		=> 'mahasiswa_pt',
			'filter' 	=> 'nipd = \''.$nim.'\'',
		];

		
		$result = $api->post($url, $params, $headers);
		
		try
		{
			
			$hasil = $result->decode_response();
			if(empty($hasil->values->output->result->id_pd))
			{
				
				$url = $host."/feeder/m/insert";
				$params = [
					'nm_pd'		=> ucwords(strtolower($m->nama_mahasiswa)),
					'id_kk' 	=> '0',
					'tmpt_lahir' 			=> ucwords(strtolower($m->tempat_lahir)),
					'tgl_lahir' 		=> $m->tgl_lahir,
					'jk'			=> $m->jenis_kelamin,
					'id_agama' 				=> '1',
					'nik'					=> $m->ktp,
					'kewarganegaraan'		=> $m->warga_negara,
					'jln'					=> $m->alamat,
					'nm_dsn'					=> $m->dusun,
					'rt'					=> $m->rt,
					'rw'					=> $m->rw,
					'ds_kel'				=> $m->desa,
					'kode_pos'				=> $m->kode_pos,
					'id_wil' 			=> $m->kecamatan_feeder,
					'id_jns_tinggal'		=> 4, //asrama,
					'id_alat_transport'	=> 1,//jalan kaki,
					'no_tel_rmh' 				=> $m->telepon,
					'no_hp'				=> $m->hp,
					'email'					=> $m->email,
					'a_terima_kps'		=> 0,
					'nm_ayah'				=> ucwords(strtolower($ayah->nama)),
					'id_pekerjaan_ayah'		=> $ayah->pekerjaan0->kode_feeder,
					'id_jenjang_pendidikan_ayah'	=> $ayah->pendidikan0->kode_feeder,
					'id_penghasilan_ayah'	=> $ayah->penghasilan0->kode_feeder,
					'id_kebutuhan_khusus_ayah' 	=> '0', 
					'nm_ibu_kandung'		=> ucwords(strtolower($ibu->nama)),
					'id_pekerjaan_ibu'		=> $ibu->pekerjaan0->kode_feeder,
					'id_jenjang_pendidikan_ibu'		=> $ibu->pendidikan0->kode_feeder,
					'id_penghasilan_ibu'	=> $ibu->penghasilan0->kode_feeder,
					'id_kebutuhan_khusus_ibu' 	=> '0',
					'nm_wali'				=> ucwords(strtolower($wali->nama)),
					'id_pekerjaan_wali'		=> $wali->pekerjaan0->kode_feeder,
					'id_jenjang_pendidikan_wali'	=> $wali->pendidikan0->kode_feeder,
					'id_penghasilan_wali'	=> $wali->penghasilan0->kode_feeder,
					
				];

				$result = $api->post($url, $params, $headers);
				
				try{
					
					$hasil = $result->decode_response();
				}

				catch(RestClientException  $e){
					print_r($e);
					//throw new RestClientException;
					$hasil = null;
				}

				if(!empty($hasil->values->output->result->id_pd))
				{
					$hsl = (array) $hasil->values->output->result->id_pd;
					$id_pd = $hsl['$value'];
					$m->kode_pd = $id_pd;
					$m->save();
					$prodi = Masterprogramstudi::model()->findByAttributes(['kode_prodi'=> $m->kode_prodi]);

					$params = [
						'id_pd'		=> $id_pd,
						'id_sp' 	=> '715253d2-bafa-429a-9ff7-a85b34ff955d',
						'nipd' 			=> $m->nim_mhs,
						'tgl_masuk_sp' => $_POST['tgl_masuk'],
						'id_jns_daftar' => 1,
						'mulai_smt'	=> $_POST['ta_masuk'],
						'id_sms' => $prodi->kode_feeder,				
					];

					$url = $host."/feeder/m/insert/pt";

					$api = new RestClient;

					$result = $api->post($url, $params, $headers);
					
					try{
						
						$hasil = $result->decode_response();
					}

					catch(RestClientException  $e){
						print_r($e);
						//throw new RestClientException;
						$hasil = null;
					}
				}
			}

			else
			{
				$hsl = (array) $hasil->values->output->result->id_pd;
				$id_pd = $hsl['$value'];
				$m->kode_pd = $id_pd;
				$m->save();
			}
		}

		catch(RestClientException  $e){
			print_r($e);
			//throw new RestClientException;
			$hasil = null;


		}

		
		
		echo json_encode($hasil);

	}

	private function readSheetOrtu($model, $sheetNum, $hubungan)
	{

		$uploadedFile = $model->uploadedFile;

		Yii::import('ext.PHPExcel.PHPExcel.**', true); 

        $fileName = $uploadedFile->getTempName();

        $objPHPExcel = PHPExcel_IOFactory::load($fileName);
        $sheet = $objPHPExcel->getSheet($sheetNum); 
        $highestRow = $sheet->getHighestRow(); 
        // $highestColumn = $sheet->getHighestColumn();
        // $highestColumn++;
        // print_r($highestColumn);
        //Loop through each row of the worksheet in turn
        $message = '';

        $list_pendidikan = [];
      	$pendidikans = Pilihan::model()->findAllByAttributes(['kode'=>'01']);

      	foreach($pendidikans as $p)
      	{
      		$list_pendidikan[$p->kode_feeder] = $p;
      	}

      	$list_pekerjaan = [];
      	$pekerjaans = Pilihan::model()->findAllByAttributes(['kode'=>'55']);

      	foreach($pekerjaans as $p)
      	{
      		$list_pekerjaan[$p->kode_feeder] = $p;
      	}

      	$list_penghasilan = [];
      	$penghasilans = Pilihan::model()->findAllByAttributes(['kode'=>'69']);

      	foreach($penghasilans as $p)
      	{
      		$list_penghasilan[$p->kode_feeder] = $p;
      	}


		$index = 1;
        for ($row = 2; $row <= $highestRow; $row++)
        {


        	$index++;
        	$nim = $sheet->getCell('B'.$row)->getValue();
        	$nik = strtoupper($sheet->getCell('C'.$row)->getValue());
        	$nama = strtoupper($sheet->getCell('D'.$row)->getValue());
        	$tgl_lahir = strtoupper($sheet->getCell('E'.$row)->getValue());
        	$pendidikan = strtoupper($sheet->getCell('F'.$row)->getValue());
        	$pekerjaan = strtoupper($sheet->getCell('G'.$row)->getValue());
        	$penghasilan = strtoupper($sheet->getCell('H'.$row)->getValue());
        	
        	$kd_feeder_pendidikan = !empty($pendidikan) ? explode(' - ', trim($pendidikan)) : [0=>6];
        	$kd_feeder_pekerjaan = !empty($pekerjaan) ? explode(' - ', trim($pekerjaan)) : [0=>99];
        	$kd_feeder_penghasilan = !empty($penghasilan) ? explode(' - ', trim($penghasilan)) : [0=>12];
        	
    		$ortu = new MahasiswaOrtu;
    		$ortu->hubungan = $hubungan;
    		$ortu->nama = $nama;
    		$ortu->nim = $nim;
    		$ortu->agama = 'I';
    		
   //  		try
			// {

    		$ortu->pendidikan = $list_pendidikan[$kd_feeder_pendidikan[0]]->value;
    		$ortu->pekerjaan = $list_pekerjaan[$kd_feeder_pekerjaan[0]]->value;
    		$ortu->penghasilan = $list_penghasilan[$kd_feeder_penghasilan[0]]->value;
    		// }

			// catch(Exception $e){
			// 	$model->addError('error',$e->getMessage());
			// 	exit;
			// 	throw new Exception();

			// }	

    		if($ortu->validate()){

    			$ortu->save();
    		}

    		else{

    			$errors = 'Baris ke-';
				$errors .= ($index + 1).' : ';
					
				foreach($ortu->getErrors() as $attribute){
					foreach($attribute as $error){
						$errors .= $error;
					}
				}
				$model->addError('error',$errors);
				throw new Exception();
    		}

			

        }

	        // $message .= '</ul>';
	     
	}


	public function actionUploadMhs()
	{

		$model = new Mastermahasiswa;
		$mhs = new Mastermahasiswa;
		if(isset($_POST['Mastermahasiswa']))
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
	        $message = '';

	      
	        $transaction=Yii::app()->db->beginTransaction();
	        try
			{
				$index = 1;
		        for ($row = 3; $row <= $highestRow; $row++)
		        { 

		        	$index++;
		        	$nim = $sheet->getCell('B'.$row)->getValue();
		        	$nama = strtoupper($sheet->getCell('C'.$row)->getValue());
		        	$nama_ibu = strtoupper($sheet->getCell('D'.$row)->getValue());
		        	$nik = strtoupper($sheet->getCell('E'.$row)->getValue());
		        	$tmpt_lahir = strtoupper($sheet->getCell('F'.$row)->getValue());
		        	$tgl_lahir = strtoupper($sheet->getCell('G'.$row)->getValue());
		        	$jk = strtoupper($sheet->getCell('H'.$row)->getValue());
		        	$jalan = strtoupper($sheet->getCell('I'.$row)->getValue());
		        	$dusun = strtoupper($sheet->getCell('J'.$row)->getValue());
		        	$rt = strtoupper($sheet->getCell('K'.$row)->getValue());
		        	$rw = strtoupper($sheet->getCell('L'.$row)->getValue());
		        	$desa = strtoupper($sheet->getCell('M'.$row)->getValue());
		        	$kecamatan = strtoupper($sheet->getCell('N'.$row)->getValue());
		        	$kota = strtoupper($sheet->getCell('O'.$row)->getValue());
		        	$provinsi = strtoupper($sheet->getCell('P'.$row)->getValue());
		        	$kodepos = strtoupper($sheet->getCell('Q'.$row)->getValue());
		        	$telp = strtoupper($sheet->getCell('R'.$row)->getValue());
		        	$hp = strtoupper($sheet->getCell('S'.$row)->getValue());
		        	$email = strtoupper($sheet->getCell('T'.$row)->getValue());
		        	$fakultas = strtoupper($sheet->getCell('U'.$row)->getValue());
		        	$prodi = strtoupper($sheet->getCell('V'.$row)->getValue());
		        	$kampus = strtoupper($sheet->getCell('W'.$row)->getValue());
		        	$tahun_masuk = strtoupper($sheet->getCell('X'.$row)->getValue());
		        	$semester_awal = strtoupper($sheet->getCell('Y'.$row)->getValue());
		        	
	        		$mhs = new Mastermahasiswa;
	        		$mhs->nim_mhs = $nim;
	        		$mhs->nama_mahasiswa = $nama;
	        		$mhs->tempat_lahir = $tmpt_lahir;
	        		$mhs->tgl_lahir = $tgl_lahir;
	        		$mhs->jenis_kelamin = $jk;
	        		$mhs->tahun_masuk = $tahun_masuk;
	        		$mhs->semester_awal = $semester_awal;
	        		$mhs->status_aktivitas = 'A';
	        		$mhs->kode_prodi = $prodi;
	        		$mhs->kode_fakultas = $fakultas;
	        		$mhs->semester = '1';
	        		$mhs->telepon = $telp;
	        		$mhs->hp = $hp;
	        		$mhs->email = $email;
	        		$mhs->alamat = $jalan;
	        		$mhs->ktp = $nik;
	        		$mhs->rt = $rt;
	        		$mhs->rw = $rw;
	        		$mhs->dusun = $dusun;
	        		$mhs->kode_pos = $kodepos;
	        		$mhs->desa = $desa;
	        		$mhs->kampus = $kampus;
	        		$mhs->agama = 'I';
	        		$mhs->provinsi = $provinsi;
	        		$mhs->kecamatan = $kecamatan;
	        		$mhs->kabupaten = $kota;
	        		$mhs->kode_pt = '073090';
	        		$mhs->kode_jenjang_studi = 'C';
	        		$mhs->is_synced = 0;
	        		
	        		if($mhs->validate()){

	        			$mhs->save();
	        			
	        		}

	        		else{
	        			
	        			$errors = 'Baris ke-';
						$errors .= ($index + 1).' : ';
							
						foreach($mhs->getErrors() as $attribute){
							foreach($attribute as $error){
								$errors .= $error;
							}
						}
						$model->addError('error',$errors);
						throw new Exception();
	        		}

					

		        }
		        
		        $this->readSheetOrtu($model,1,'AYAH');
		        
		        $this->readSheetOrtu($model,2,'IBU');
		        $this->readSheetOrtu($model,3,'WALI');

		        // $message .= '</ul>';
		        // $this->redirect(array('trRawatInap/lainnya','id'=>$id));
		        $transaction->commit();

		        if(!empty($message))
		        	$message = '<strong style="color:red">Catatan</strong><div style="color:orange">Sebagian data sukses terunggah. Ada beberapa belum, yaitu:</div>'.$message;
		        // $message = empty($message) ? ' Namun, '.$message : '';
		        Yii::app()->user->setFlash('success', "Data Mahasiswa telah diunggah.".$message);
				$this->redirect(['index']);
	        }

			catch(Exception $e){
				Yii::app()->user->setFlash('error', print_r($e));
				$transaction->rollback();
			}	
	    }


		$this->render('upload_mhs',array(
			'model' => $model,
			

		));

	}

	public function actionAjaxFindNegara()
	{

		$params = ['key' => $_GET['term']];
		$hasil = Yii::app()->rest->getListNegara($params);
			


		$result = [];
		if(!empty($hasil->values))
		{
			foreach($hasil->values as $item)
			{
				$result[] = [
					'id' => $item->id_negara,
					'value' => $item->id_negara.' - '.$item->nm_negara,
				];
			}
		}

		echo CJSON::encode($result);
	}

	public function actionAjaxFindWilayahOne()
	{

		$params = ['key' => $_GET['term']];
		$hasil = Yii::app()->rest->getListWilayahOne($params);


		$result = [];
		if(!empty($hasil->values))
		{
			$item = $hasil->values;
			$result[] = [
				'id' => $item->id_wil,
				'value' => $item->nm_wil,
				'id_induk_wilayah' => $item->id_induk_wilayah
			];
		}

		echo CJSON::encode($result);
	}

	public function actionAjaxFindWilayah()
	{

		$params = ['key' => $_GET['term']];
		$hasil = Yii::app()->rest->getListWilayah($params);
			


		$result = [];
		if(!empty($hasil->values))
		{
			foreach($hasil->values as $item)
			{
				$result[] = [
					'id' => $item->id_wil,
					'value' => $item->id_wil.' - '.$item->nm_wil,
					'id_induk_wilayah' => $item->id_induk_wilayah
				];
			}
		}

		echo CJSON::encode($result);
	}

	public function actionUpdatebio()
	{
		if(!empty($_POST['kode_prodi']))
		{
			$c = new CDbCriteria;
			$c->condition = 'kode_prodi = :p1 AND kampus = :p2 AND semester_awal= :p3 ';
			$c->params = [
				':p1' => $_POST['kode_prodi'],
				':p2' => $_POST['kampus'],
				':p3' => $_POST['ta_masuk']
			];
			$c->order = 'nim_mhs ASC';
			$mahasiswas = Mastermahasiswa::model()->findAll($c);
			
			foreach($mahasiswas as $m)
			{	


				if(!empty($_POST['tgl_lahir_'.$m->nim_mhs]))
				{

					$m->tgl_lahir = $_POST['tgl_lahir_'.$m->nim_mhs];
				}

				if($m->tgl_lahir == '0000-00-00'){
					$m->tgl_lahir = NULL;
				}
				if(!empty($_POST['id_kecamatan_'.$m->nim_mhs]))
					$m->kecamatan_feeder = $_POST['id_kecamatan_'.$m->nim_mhs];

				if(!empty($_POST['nama_kecamatan_'.$m->nim_mhs]))
					$m->kecamatan = $_POST['nama_kecamatan_'.$m->nim_mhs];
				
				if(!empty($_POST['id_negara_'.$m->nim_mhs]))
					$m->warga_negara_feeder = $_POST['id_negara_'.$m->nim_mhs];
				
				$m->tempat_lahir = $_POST['tempat_lahir_'.$m->nim_mhs];
				$m->ktp = $_POST['ktp_'.$m->nim_mhs];
				$m->save();
			}
			Yii::app()->user->setFlash('success', "Data Saved.");
			$this->redirect([
				'mastermahasiswa/dataortu',
				'kode_prodi'=>$_POST['kode_prodi'],
				'kampus' => $_POST['kampus'],
				'ta_masuk' => $_POST['ta_masuk'],
				'tgl_masuk' => $_POST['tgl_masuk']
			]);
		}
	}

	public function actionDataortu($kode_prodi='',$kampus='', $ta_masuk='',$tgl_masuk='', $xls='')
	{

		$mahasiswas = new Mastermahasiswa;
		$mprodi = new Masterprogramstudi;
		if(!empty($_GET['kode_prodi']))
		{
			$c = new CDbCriteria;
			$c->condition = 'kode_prodi = :p1 AND kampus = :p2 AND semester_awal= :p3 ';
			$c->params = [
				':p1' => $_GET['kode_prodi'],
				':p2' => $_GET['kampus'],
				':p3' => $_GET['ta_masuk']
			];
			$c->order = 'nim_mhs ASC';
			$mahasiswas = Mastermahasiswa::model()->findAll($c);
			// $mahasiswas = Mastermahasiswa::model()->findAllByAttributes([
			// 	'kode_prodi' => $_GET['kode_prodi'],
			// 	'kampus' => $_GET['kampus']
			// ],['order' => 'nim_mhs DESC']);

			$mprodi = Masterprogramstudi::model()->findByAttributes([
				'kode_prodi'=> $kode_prodi
			]);
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => 51]);

		$list_agama = [];
		foreach($tmp as $v)
		{
			$list_agama[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '01']);

		$list_pendidikan = [];
		foreach($tmp as $v)
		{
			$list_pendidikan[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '55']);

		$list_pekerjaan = [];
		foreach($tmp as $v)
		{
			$list_pekerjaan[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '69']);

		$list_penghasilan = [];
		foreach($tmp as $v)
		{
			$list_penghasilan[$v->value] = $v->label;
		}

		$tmp = Pilihan::model()->findAllByAttributes(['kode' => '53']);

		$list_keadaan = [];
		foreach($tmp as $v)
		{
			$list_keadaan[$v->value] = $v->label;
		}


		if($xls == 'y')
		{
			$mahasiswas = Mastermahasiswa::model()->findAllByAttributes([
				'kode_prodi' => $kode_prodi,
				'kampus' => $kampus,
				'semester_awal' => $ta_masuk
			],['order' => 'nama_mahasiswa ASC']);

			$mprodi = Masterprogramstudi::model()->findByAttributes(['kode_prodi'=> $kode_prodi]);

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
			$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);
			$sheet = $objPHPExcel->setActiveSheetIndex(0);
			$style = array(
		        'alignment' => array(
		            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
		        )
		    );

		    $sheet->getDefaultStyle()->applyFromArray($style);
			$headers = array(
			   'A' => 'No',
			   'B' =>'NIM',
			   'C' =>'Nama',
			   'D' =>'TTL',
			   'E' =>'JK',
			   'F' =>'ALAMAT',
			   'G' =>'KTP',
			   'H' =>'PRODI',
			   'I' =>'FAKULTAS',
			   'J' =>'TAHUN MASUK',
			   'K' =>'AGAMA',
			   'L' => 'Nama',
			   'M' => 'ALAMAT',
			   'N' => 'Agama',
			   'O' => 'Pendidikan',
			   'P' => 'Pekerjaan',
			   'Q' => 'Penghasilan',
			   'R' => 'Keadaan',
			   'S' => 'Nama',
			   'T' => 'ALAMAT',
			   'U' => 'Agama',
			   'V' => 'Pendidikan',
			   'W' => 'Pekerjaan',
			   'X' => 'Penghasilan',
			   'Y' => 'Keadaan',
			);
			
			$idx = 1;
			$sheet->mergeCells('L1:R1');
			$sheet->setCellValue('L1', 'AYAH/WALI');
			$sheet->mergeCells('S1:Y1');
			$sheet->setCellValue('S1', 'IBU');
			foreach($headers as $q => $v)
		    {
		    	if($idx > 11) 
		    		break;

		    	$sheet->mergeCells($q.'1:'.$q.'2');
		    	$sheet->setCellValue($q.'1', strtoupper($v));
		    	// $sheet->setCellValueByColumnAndRow($idx,$row, strtoupper($v));
		    	
		    	// $cell = $sheet->getCellByColumnAndRow($idx,$row);
		    	$sheet->getStyle($q.'1')->applyFromArray(
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

		    	
		    	
		    	$idx++;
		    	
		    }

		    $idx = 1;
		    foreach($headers as $q => $v)
		    {
		    	if($idx > 11) 
		    	{		
			    	$sheet->mergeCells($q.'1:'.$q.'2');
			    	$sheet->setCellValue($q.'2', strtoupper($v));
			    	// $sheet->setCellValueByColumnAndRow($idx,$row, strtoupper($v));
			    	
			    	// $cell = $sheet->getCellByColumnAndRow($idx,$row);
			    	$sheet->getStyle($q.'2')->applyFromArray(
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
		    	$idx++;
		    	
		    }
	    
		    $sheet = $objPHPExcel->setActiveSheetIndex(0);
		    $sheet->getColumnDimension('A')->setWidth(5);
		    $sheet->getColumnDimension('B')->setWidth(20);
		    $sheet->getColumnDimension('C')->setWidth(30);
		    $sheet->getColumnDimension('D')->setWidth(18);
		    $sheet->getColumnDimension('E')->setWidth(5);
		    $sheet->getColumnDimension('F')->setWidth(42);
		    $sheet->getColumnDimension('G')->setWidth(20);
		    $sheet->getColumnDimension('H')->setWidth(30);
		    $sheet->getColumnDimension('I')->setWidth(30);
		    $sheet->getColumnDimension('J')->setWidth(15);
		    $sheet->getColumnDimension('K')->setWidth(10);
		    $sheet->getColumnDimension('L')->setWidth(20);
		    $sheet->getColumnDimension('M')->setWidth(42);
		    $sheet->getColumnDimension('N')->setWidth(10);
		    $sheet->getColumnDimension('O')->setWidth(25);
		    $sheet->getColumnDimension('P')->setWidth(25);
		    $sheet->getColumnDimension('Q')->setWidth(25);
		    $sheet->getColumnDimension('R')->setWidth(25);
		    $sheet->getColumnDimension('S')->setWidth(20);
		    $sheet->getColumnDimension('T')->setWidth(42);
		    $sheet->getColumnDimension('U')->setWidth(10);
		    $sheet->getColumnDimension('V')->setWidth(25);
		    $sheet->getColumnDimension('W')->setWidth(25);
		    $sheet->getColumnDimension('X')->setWidth(25);
		    $sheet->getColumnDimension('Y')->setWidth(25);
		    
		     $sheet->setTitle('Data Ortu');
			 $i = 0;

			

			 $row = 2;
			foreach($mahasiswas as $m)
			{
				$row++;
				$q = $m->agama ?: 'I';
				$agama = $list_agama[$q];
				$sheet->setCellValueByColumnAndRow(0,$row, ($i+1));
				$sheet->setCellValueByColumnAndRow(1,$row, $m->nim_mhs);
				$sheet->setCellValueByColumnAndRow(2,$row, $m->nama_mahasiswa);
				$sheet->setCellValueByColumnAndRow(3,$row, $m->tempat_lahir.', '.date('d/m/Y',strtotime($m->tgl_lahir)));
				$sheet->setCellValueByColumnAndRow(4,$row, $m->jenis_kelamin);
				$sheet->setCellValueByColumnAndRow(5,$row, $m->alamat.' '.$m->rt.' '.$m->rw.' '.$m->dusun.' '.$m->desa.' '.$m->kecamatan.' '.$m->kabupaten.' '.$m->provinsi);
				$sheet->setCellValueByColumnAndRow(6,$row, $m->ktp);
				$sheet->setCellValueByColumnAndRow(7,$row, $m->kodeProdi->singkatan);
				$sheet->setCellValueByColumnAndRow(8,$row, $m->kodeProdi->fakultas->nama_fakultas);
				$sheet->setCellValueByColumnAndRow(9,$row, substr($m->nim_mhs, 2,4));
				$sheet->setCellValueByColumnAndRow(10,$row, $agama ?: 'ISLAM');
			
				$i++;

				if(!empty($m->ortus))
				{
					foreach($m->ortus as $ortu)
					{
						

						if($ortu->hubungan == 'AYAH' || $ortu->hubungan == 'WALI')
						{
							$sheet->setCellValueByColumnAndRow(11,$row, ucwords($ortu->nama));
							// $sheet->setCellValueByColumnAndRow(12,$row, $ortu->fullalamat);
							$sheet->setCellValueByColumnAndRow(12,$row, $ortu->agama ?: '-');
							$sheet->setCellValueByColumnAndRow(13,$row, $ortu->pendidikan ?: '-');
							$sheet->setCellValueByColumnAndRow(14,$row, $ortu->pekerjaan ?: '-');
							$sheet->setCellValueByColumnAndRow(15,$row, $ortu->penghasilan ?: '-');
							$sheet->setCellValueByColumnAndRow(16,$row, $ortu->hidup ?: '-');

						}

						else if($ortu->hubungan == 'IBU'){
							$sheet->setCellValueByColumnAndRow(17,$row, ucwords($ortu->nama));
							// $sheet->setCellValueByColumnAndRow(19,$row, $ortu->fullalamat);
							$sheet->setCellValueByColumnAndRow(18,$row, $ortu->agama ?: '-');
							$sheet->setCellValueByColumnAndRow(19,$row, $ortu->pendidikan ?: '-');
							$sheet->setCellValueByColumnAndRow(20,$row, $ortu->pekerjaan ?: '-');
							$sheet->setCellValueByColumnAndRow(21,$row, $ortu->penghasilan ?: '-');
							$sheet->setCellValueByColumnAndRow(22,$row, $ortu->hidup ?: '-');
						}
					}
				}
			}

			$sheet->getStyle('F1:F'.$objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

			
			$sheet->getStyle('F1:F'.$objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setVertical(true); 
		    

		    ob_end_clean();
		    ob_start();
		    
		    header('Content-Type: application/vnd.ms-excel');
		    header('Content-Disposition: attachment;filename="dataortu_'.$mprodi->nama_prodi.'.xls"');
		    header('Cache-Control: max-age=0');
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		    $objWriter->save('php://output');
			// $this->renderPartial('_dataortu_table',[
			// 	'mahasiswas' => $mahasiswas,
			// 	'kdprodi' => $kdprodi,
			// 	'xls' => $xls,
			// 	'mprodi' => $mprodi
			// ]);

			exit;
		}

		$this->render('dataortu',[
			'mahasiswas' => $mahasiswas,
			'kdprodi' => $kode_prodi,
			'xls' => $xls,
			'mprodi' => $mprodi,
			'list_agama' => $list_agama,
			'list_pendidikan' => $list_pendidikan,
			'list_pekerjaan'=>$list_pekerjaan,
			'list_penghasilan' => $list_penghasilan,
			'list_keadaan' => $list_keadaan
		]);
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
	    
	    $objPHPExcel->getActiveSheet()->setTitle('mhs_pa');
	 
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

		        $transaction->commit();
		        Yii::app()->user->setFlash('success', "Data PA telah diunggah");
				$this->redirect(array('uploadPA'));
		        // exit;
				
				// exit;
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
		$this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mastermahasiswa('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['filter']))
			$model->SEARCH=$_GET['filter'];

		if(isset($_GET['size']))
			$model->PAGE_SIZE=$_GET['size'];

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
