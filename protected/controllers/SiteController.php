<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionDataortu($kdprodi='',$xls='')
	{
		$mahasiswas = new Mastermahasiswa;
		$mprodi = new Masterprogramstudi;
		if(!empty($_GET['kode_prodi']))
		{
			$mahasiswas = Mastermahasiswa::model()->findAllByAttributes([
				'kode_prodi' => $_GET['kode_prodi'],
				'kampus' => $_GET['kampus']
			],['order' => 'nim_mhs DESC']);

			$mprodi = Masterprogramstudi::model()->findByAttributes([
				'kode_prodi'=> $kdprodi
			]);
		}

		$tmp = $agama = Pilihan::model()->findAllByAttributes([
			'kode' => 51,
			// 'value' => $m->agama
		]);



		$list_agama = [];
		foreach($tmp as $v)
		{
			$list_agama[$v->value] = $v->label;
		}

		// print_r($list_agama);exit;

		if($xls == 'y')
		{
			$mahasiswas = Mastermahasiswa::model()->findAllByAttributes([
				'kode_prodi' => $kdprodi
			],['order' => 'nim_mhs DESC']);

			$mprodi = Masterprogramstudi::model()->findByAttributes(['kode_prodi'=> $kdprodi]);

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
			$row = 1;
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

			


			foreach($mahasiswas as $m)
			{
				$row++;
				$agama = Pilihan::model()->findByAttributes([
					'kode' => 51,
					'value' => $m->agama
				]);
				$sheet->setCellValueByColumnAndRow(0,$row, ($i+1));
				$sheet->setCellValueByColumnAndRow(1,$row, $m->nim_mhs);
				$sheet->setCellValueByColumnAndRow(2,$row, $m->nama_mahasiswa);
				$sheet->setCellValueByColumnAndRow(3,$row, $m->tempat_lahir.', '.date('d/m/Y',strtotime($m->tgl_lahir)));
				$sheet->setCellValueByColumnAndRow(4,$row, $m->jenis_kelamin);
				$sheet->setCellValueByColumnAndRow(5,$row, $m->alamat.' '.$m->rt.' '.$m->rw.' '.$m->dusun.' '.$m->desa.' '.$m->kecamatan.' '.$m->kabupaten.' '.$m->provinsi);
				$sheet->setCellValueByColumnAndRow(6,$row, $m->ktp);
				$sheet->setCellValueByColumnAndRow(7,$row, $m->prodi->nama_prodi);
				$sheet->setCellValueByColumnAndRow(8,$row, $m->prodi->fakultas->nama_fakultas);
				$sheet->setCellValueByColumnAndRow(9,$row, substr($m->nim_mhs, 2,4));
				$sheet->setCellValueByColumnAndRow(10,$row, !empty($agama) ? $agama->label : 'ISLAM');
			
				$i++;

				if(!empty($m->ortus))
				{
					foreach($m->ortus as $ortu)
					{
						$agama = Pilihan::model()->findByAttributes([
							'kode' => 51,
							'value' => $ortu->agama
						]);

						$pendidikan = Pilihan::model()->findByAttributes([
							'kode' => '01',
							'value' => $ortu->pendidikan
						]);

						$pekerjaan = Pilihan::model()->findByAttributes([
							'kode' => 55,
							'value' => $ortu->pekerjaan
						]);

						$penghasilan = Pilihan::model()->findByAttributes([
							'kode' => 69,
							'value' => $ortu->penghasilan
						]);

						$keadaan = Pilihan::model()->findByAttributes([
							'kode' => 53,
							'value' => $ortu->hidup
						]);

						if($ortu->hubungan == 'AYAH' || $ortu->hubungan == 'WALI')
						{
							$sheet->setCellValueByColumnAndRow(11,$row, ucwords($ortu->nama));
							$sheet->setCellValueByColumnAndRow(12,$row, $ortu->fullalamat);
							$sheet->setCellValueByColumnAndRow(13,$row, !empty($agama) ? $agama->label : '-');
							$sheet->setCellValueByColumnAndRow(14,$row, !empty($pendidikan) ? $pendidikan->label : '-');
							$sheet->setCellValueByColumnAndRow(15,$row, !empty($pekerjaan) ? $pekerjaan->label : '-');
							$sheet->setCellValueByColumnAndRow(16,$row, !empty($penghasilan) ? $penghasilan->label : '-');
							$sheet->setCellValueByColumnAndRow(17,$row, !empty($keadaan) ? $keadaan->label : '-');

						}

						else if($ortu->hubungan == 'IBU'){
							$sheet->setCellValueByColumnAndRow(18,$row, ucwords($ortu->nama));
							$sheet->setCellValueByColumnAndRow(19,$row, $ortu->fullalamat);
							$sheet->setCellValueByColumnAndRow(20,$row, !empty($agama) ? $agama->label : '-');
							$sheet->setCellValueByColumnAndRow(21,$row, !empty($pendidikan) ? $pendidikan->label : '-');
							$sheet->setCellValueByColumnAndRow(22,$row, !empty($pekerjaan) ? $pekerjaan->label : '-');
							$sheet->setCellValueByColumnAndRow(23,$row, !empty($penghasilan) ? $penghasilan->label : '-');
							$sheet->setCellValueByColumnAndRow(24,$row, !empty($keadaan) ? $keadaan->label : '-');
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
			'kdprodi' => $kdprodi,
			'xls' => $xls,
			'mprodi' => $mprodi,
			'list_agama' => $list_agama
		]);
	}

	public function actionMaster()
	{
		$this->render('master');
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->actionLogin();
	}

	public function actionHome()
	{
		$this->render('home');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
	{
	
		$model=new User;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User']))
		{
		
			
			$model->attributes=$_POST['User'];
			$result = $model->login();
			// validate user input and redirect to the previous page if valid
			switch($result)
			{
				case UserIdentity::ERROR_NONE:
					
					$time_expiration = time()+60*60*24*7; 
					$tahunaktif = Tahunakademik::model()->findByAttributes(array('buka'=> 'Y'));	
					$cookie = new CHttpCookie('tahunaktif', $tahunaktif->tahun_id);
					$cookie->expire = $time_expiration; 
					Yii::app()->request->cookies['tahunaktif'] = $cookie;	
					$this->redirect(Yii::app()->createUrl('jadwal/index'));
					
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$model->addError('username','Incorrect username or password.');
					
					break;
				case UserIdentity::ERROR_USER_INACTIVE:

					$model->addError('username','Akun Anda belum aktif. Silakan menghubungi Administrator.');
					
					break;
			}
			
		}
		
		
		
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('site/login'));
	}
	
}