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
				,'uploadJadwal','cetakPerDosen','cetakPersonal','rekapJadwal','rekapJadwalXls','rekapJadwalAll','exportRekap','listBentrok','rekapJadwalAllXls'),
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

	public function actionListBentrok()
	{
		$model=new Jadwal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Jadwal']))
			$model->attributes=$_GET['Jadwal'];

		$this->render('listBentrok',array(
			'model'=>$model,
		));
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

	public function actionRekapJadwalAllXls()
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$jadwal_prodi = Jadwal::model()->findRekapJadwalAll($tahun_akademik->tahun_id);
		Yii::import('ext.PHPExcel.PHPExcel');
		$objPHPExcel = new PHPExcel();
		$styleArray = array(
		    'font'  => array(
		        // 'bold'  => true,
		        // 'color' => array('rgb' => 'FF0000'),
		        'size'  => 7,
		        'name'  => 'Times New Roman'
		    ),
		    'alignment' => array(
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        ),
		    

		);
		$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);

		$headers = array(
		   'No',
		   'Hari',
		   'Jam',
		   'Waktu',
		   'Kode MK',
		   'Mata Kuliah',
		   'NIY',
		   'Nama Dosen',
		   'SKS',
		   'Fakultas',
		   'Prodi',
		   'SMT',
		   'Kampus',
		   'KLS',
		);
    
	    $sheet = $objPHPExcel->setActiveSheetIndex(0);
	    $sheet->setCellValueByColumnAndRow(0, 1, "JADWAL REKAP SKS DOSEN");
	    $sheet->setCellValueByColumnAndRow(0, 2, "UNIVERSITAS DARUSSALAM GONTOR");
	    $sheet->setCellValueByColumnAndRow(0, 3, "TAHUN AKADEMIK ".strtoupper($tahun_akademik->nama_tahun));
	    $sheet->mergeCells('A1:N1');
	    $sheet->mergeCells('A2:N2');
	    $sheet->mergeCells('A3:N3');
	    $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        ),
	        'font'  => array(
		        'bold'  => true,
		        // 'color' => array('rgb' => 'FF0000'),
		        
		    ),
	    );

	    $sheet->getStyle("A1:N1")->applyFromArray($style);
	    $sheet->getStyle("A2:N2")->applyFromArray($style);
	    $sheet->getStyle("A3:N3")->applyFromArray($style);
	    for($i=1;$i<=3;$i++)
	    	$sheet->getRowDimension($i)->setRowHeight(15);

	    $objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();
		$objDrawing->setName('Image');
		$baseUrl = realpath(Yii::app()->basePath . '/../images');
		// $baseUrl = $_SERVER['DOCUMENT_ROOT'].'/simjad';
		$objDrawing->setPath($baseUrl.'/logo_unida.png');
		$objDrawing->setHeight(45);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($sheet);

	    $sheet->getColumnDimension('A')->setWidth(4);
	    $sheet->getColumnDimension('B')->setWidth(8);
	    $sheet->getColumnDimension('C')->setWidth(4);
	    $sheet->getColumnDimension('D')->setWidth(12);
	    $sheet->getColumnDimension('E')->setWidth(12);
	    $sheet->getColumnDimension('F')->setWidth(52);
	    $sheet->getColumnDimension('G')->setWidth(8);
	    $sheet->getColumnDimension('H')->setWidth(42);
	    $sheet->getColumnDimension('I')->setWidth(6);
	    $sheet->getColumnDimension('J')->setWidth(15);
	    $sheet->getColumnDimension('K')->setWidth(7);
	    $sheet->getColumnDimension('L')->setWidth(6);
	    $sheet->getColumnDimension('M')->setWidth(12);
	    $sheet->getColumnDimension('N')->setWidth(6);
	    
	    $rowStart = 4;
	    foreach($headers as $q => $v)
	    {
	    	$sheet->setCellValueByColumnAndRow($q,$rowStart, strtoupper($v));
	    	$cell = $sheet->getCellByColumnAndRow($q,$rowStart);

	    	$cell->getStyle($cell->getColumn().$cell->getRow())->applyFromArray(
	    		array(
	    			'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '000000')
			        ),
			        'font' => array(
			        	'color' => array('rgb'=> 'ffffff')
			        ),
			        'borders' => array(
				    	'allborders' => array(
			                'style' => PHPExcel_Style_Border::BORDER_THIN,
			                'color' => array('rgb' => '000000')
			            )
				    )
			        // 'alignment' => array('indent'=>'10')
	    		)
	    	);
	    }

	   	$i = 0; 

		$row = $rowStart;
		foreach($jadwal_prodi as $jd)
		{
			$sks_dosen = 0;
			$jadwal_perdosen = Jadwal::model()->findRekapJadwalPerDosenAll($tahun_akademik->tahun_id,$jd->kode_dosen);
			foreach($jadwal_perdosen as $m)
			{	
		  		$sks_dosen += $m->SKS;

				$i++;
				$sheet->getRowDimension($row+1)->setRowHeight(15);
				$sheet->setCellValueByColumnAndRow(0,$row+1, $i);
				$sheet->setCellValueByColumnAndRow(1,$row+1, $m->hari);
				$sheet->setCellValueByColumnAndRow(2,$row+1, $m->jAM->nama_jam);
				$sheet->setCellValueByColumnAndRow(3,$row+1, substr($m->jAM->jam_mulai, 0, -3).'-'.substr($m->jAM->jam_selesai, 0, -3));
				$sheet->setCellValueByColumnAndRow(4,$row+1, $m->kode_mk);
				$sheet->setCellValueByColumnAndRow(5,$row+1, $m->nama_mk);
				$sheet->setCellValueByColumnAndRow(6,$row+1, $m->kode_dosen);
				$sheet->setCellValueByColumnAndRow(7,$row+1, $m->nama_dosen);
				$sheet->setCellValueByColumnAndRow(8,$row+1, $m->SKS);
				$sheet->setCellValueByColumnAndRow(9,$row+1, $m->nama_fakultas);
				$prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$m->prodi));
	 			$nm_prodi = !empty($prodi) ? $prodi->singkatan : $m->nama_prodi;
				$sheet->setCellValueByColumnAndRow(10,$row+1, $nm_prodi);
				$sheet->setCellValueByColumnAndRow(11,$row+1, $m->semester);
				$sheet->setCellValueByColumnAndRow(12,$row+1, $m->kAMPUS->nama_kampus);
				$sheet->setCellValueByColumnAndRow(13,$row+1, $m->kELAS->nama_kelas);
			  	foreach($headers as $q => $v)
	    		{
				  	$cell = $sheet->getCellByColumnAndRow($q,$row+1);
				  	$cell->getStyle($cell->getColumn().$cell->getRow())->applyFromArray(
			    		array(
					        'borders' => array(
						    	'allborders' => array(
					                'style' => PHPExcel_Style_Border::BORDER_THIN,
					                'color' => array('rgb' => '000000')
					            )
						    )
					        // 'alignment' => array('indent'=>'10')
			    		)
			    	);
			  	}

			  	$row++;

			  	
			}

			$sheet->getRowDimension($row+1)->setRowHeight(15);
			$sheet->setCellValueByColumnAndRow(0,$row+1, '');
			$sheet->setCellValueByColumnAndRow(1,$row+1, '');
			$sheet->setCellValueByColumnAndRow(2,$row+1, '');
			$sheet->setCellValueByColumnAndRow(3,$row+1, '');
			$sheet->setCellValueByColumnAndRow(4,$row+1, '');
			$sheet->setCellValueByColumnAndRow(5,$row+1, '');
			$sheet->setCellValueByColumnAndRow(6,$row+1, '');
			$sheet->setCellValueByColumnAndRow(7,$row+1, 'Total SKS');
			$sheet->getStyle('H'.($row+1))
				->getAlignment()
    			->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$sheet->setCellValueByColumnAndRow(8,$row+1, $sks_dosen);
			$sheet->setCellValueByColumnAndRow(9,$row+1, '');
			$sheet->setCellValueByColumnAndRow(10,$row+1, '');
			$sheet->setCellValueByColumnAndRow(11,$row+1, '');
			$sheet->setCellValueByColumnAndRow(12,$row+1, '');
			$sheet->setCellValueByColumnAndRow(13,$row+1, '');
			foreach($headers as $q => $v)
    		{
			  	$cell = $sheet->getCellByColumnAndRow($q,$row+1);

			  	$font_color = '000000';
			  	if($sks_dosen >= 20)
			  	{
			  		$font_color = 'f50c0c';
			  	} 

			  	else if($sks_dosen <= 15)
			  	{
			  		$font_color = 'ff8c00';
			  	}

			  	$cell->getStyle($cell->getColumn().$cell->getRow())->applyFromArray(
		    		array(
				        'borders' => array(
					    	'allborders' => array(
				                'style' => PHPExcel_Style_Border::BORDER_THIN,
				                'color' => array('rgb' => '000000')
				            )
					    ),
					    'fill' => array(
				            'type' => PHPExcel_Style_Fill::FILL_SOLID,
				            'color' => array('rgb' => $font_color)
				        ),
				        'font'  => array(
					        'bold'  => true,
					        
					    ),
				        
				        // 'alignment' => array('indent'=>'10')
		    		)
		    	);
		  	}

			$row++;
	    }
	    $sheet->setTitle('Rekap Jadwal');
	 
	    $objPHPExcel->setActiveSheetIndex(0);
	     
	    ob_end_clean();
	    ob_start();
	    
	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="rekap_jadwal_all.xls"');
	    header('Cache-Control: max-age=0');
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	    $objWriter->save('php://output');
	}

	public function actionRekapJadwalXls($id)
	{
		$prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$id));
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

		$headers = array(
		   'No',
		   'Hari',
		   'Jam',
		   'Waktu',
		   'Kode MK',
		   'Mata Kuliah',
		   'NIY',
		   'Nama Dosen',
		   'SKS',
		   'Fakultas',
		   'Prodi',
		   'SMT',
		   'Kampus',
		   'Kelas',
		);
    
	    $sheet = $objPHPExcel->setActiveSheetIndex(0);

	    $sheet->getColumnDimension('A')->setWidth(4);
	    $sheet->getColumnDimension('B')->setWidth(8);
	    $sheet->getColumnDimension('C')->setWidth(4);
	    $sheet->getColumnDimension('D')->setWidth(12);
	    $sheet->getColumnDimension('E')->setWidth(12);
	    $sheet->getColumnDimension('F')->setWidth(52);
	    $sheet->getColumnDimension('G')->setWidth(8);
	    $sheet->getColumnDimension('H')->setWidth(42);
	    $sheet->getColumnDimension('I')->setWidth(5);
	    $sheet->getColumnDimension('J')->setWidth(15);
	    $sheet->getColumnDimension('K')->setWidth(7);
	    $sheet->getColumnDimension('L')->setWidth(6);
	    $sheet->getColumnDimension('M')->setWidth(12);
	    $sheet->getColumnDimension('N')->setWidth(6);
	    
	    $kampuses = Jadwal::model()->findKampus($id);

		foreach($kampuses as $kampus)
		{	
			foreach($kampus->kelases as $kelas)
			{
				
				$semesters = Jadwal::model()->findSemester($id);

				$row = 1;
				foreach($semesters as $semester)
				{
					foreach($headers as $q => $v)
				    {
				    	$sheet->setCellValueByColumnAndRow($q,$row, strtoupper($v));
				    	$cell = $sheet->getCellByColumnAndRow($q,$row);
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

					$model = Jadwal::model()->findRekapJadwalPerkelas($id, $kampus->id, $kelas->id, $semester->semester);

					// $rowSub = $row+1;
					foreach($model as $m)
					{
						$i++;
						$sheet->setCellValueByColumnAndRow(0,$row+1, $i);
						$sheet->setCellValueByColumnAndRow(1,$row+1, $m->hari);
						$sheet->setCellValueByColumnAndRow(2,$row+1, $m->jAM->nama_jam);
						$sheet->setCellValueByColumnAndRow(3,$row+1, substr($m->jAM->jam_mulai, 0, -3).'-'.substr($m->jAM->jam_selesai, 0, -3));
						$sheet->setCellValueByColumnAndRow(4,$row+1, $m->kode_mk);
						$sheet->setCellValueByColumnAndRow(5,$row+1, $m->nama_mk);
						$sheet->setCellValueByColumnAndRow(6,$row+1, $m->kode_dosen);
						$sheet->setCellValueByColumnAndRow(7,$row+1, $m->nama_dosen);
						$sheet->setCellValueByColumnAndRow(8,$row+1, $m->SKS);
						$sheet->setCellValueByColumnAndRow(9,$row+1, $m->nama_fakultas);
						$prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$m->prodi));
			 			$nm_prodi = !empty($prodi) ? $prodi->singkatan : $m->nama_prodi;
						$sheet->setCellValueByColumnAndRow(10,$row+1, $nm_prodi);
						$sheet->setCellValueByColumnAndRow(11,$row+1, $m->semester);
						$sheet->setCellValueByColumnAndRow(12,$row+1, $m->kAMPUS->nama_kampus);
						$sheet->setCellValueByColumnAndRow(13,$row+1, $m->kELAS->nama_kelas);
					  	$row++;
					}

					
				}
			}
		}	   
	    
	    $sheet->setTitle('Rekap Jadwal');
	 
	    $objPHPExcel->setActiveSheetIndex(0);
	     
	    ob_end_clean();
	    ob_start();
	    
	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="rekap_jadwal_'.$prodi->singkatan.'.xls"');
	    header('Cache-Control: max-age=0');
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	    $objWriter->save('php://output');
	}

	public function actionRekapJadwalAll()
	{
		
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$jadwal_prodi = Jadwal::model()->findRekapJadwalAll($tahun_akademik->tahun_id);

		$this->render('rekap_jadwal_all',array(
			'jadwal_prodi' => $jadwal_prodi,
			'tahun_akademik' => $tahun_akademik

		));
	}

	public function actionRekapJadwal()
	{
		
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		
		$this->render('rekap_jadwal',array(

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
		if(!empty($_POST['cetak']))
		{
			$kode_prodi = $_POST['kode_prodi'];
			
			$listprodi = Jadwal::model()->findJadwalPerProdi($kode_prodi);


			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
				                'L', 'mm', 'A4', true, 'UTF-8');

			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetAutoPageBreak(TRUE,10);
			$this->layout = '';
			
			// $data = '';
			foreach($listprodi as $p)
			{

				$id = $p->niy;

				$model = Jadwal::model()->findAllByAttributes(array('kode_dosen'=>$id));
				$dosen = Masterdosen::model()->findByAttributes(array('niy'=>$id));

				
				
				$pdf->AddPage();
				
				
				ob_start();	
				echo $this->renderPartial('print_jadwalpersonal',array(
					'model'=>$model,
					'dosen' => $dosen
				));

				$data = ob_get_clean();
				
				
				$pdf->writeHTML($data);
				// $pdf->endPage();
			}
			
			ob_end_clean();
			
			$pdf->Output();
			
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
	        $message = '';

	        $transaction=Yii::app()->db->beginTransaction();
	        try
			{
				$index = 0;
		        for ($row = 2; $row <= $highestRow; $row++)
		        { 


		        	$hari = strtoupper($sheet->getCell('A'.$row));
					
					if(empty($hari))continue;
		        	$jam_ke = $sheet->getCell('B'.$row);

		        	$jam = Jam::model()->findByAttributes(array('nama_jam'=>trim($jam_ke)));

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

		        	$jam_mulai = trim($waktu[0]);


		        	$jam_selesai = trim($waktu[1]);
		        	// echo $id_jam_ke;
		        	$kode_mk = $sheet->getCell('D'.$row);
		        	$nama_mk = $sheet->getCell('E'.$row);

		        	$kode_dosen = $sheet->getCell('F'.$row);

		        	$fakultas = $sheet->getCell('I'.$row);
		        	$prodi = $sheet->getCell('K'.$row);

		        	$nama_dosen = $sheet->getCell('G'.$row);
		        	$tahun_akademik = $sheet->getCell('M'.$row);
		        	$sks = $sheet->getCell('Q'.$row);
		        	$mk = Mastermatakuliah::model()->findByAttributes(array('kode_mata_kuliah'=>$kode_mk));
		        	if(empty($mk))
		        	{

		        		$isnew = Mastermatakuliah::model()->quickCreate($tahun_akademik, $fakultas, $prodi, $kode_mk, $nama_mk,$kode_dosen, $sks);
		        		
		        		if(!$isnew)
		        		{

		        			$message .= '<div style="color:red">Wrong data mk</div>';
		        				continue;
			        		$m->addError('error','Terjadi kesalahan input data mk');
							throw new Exception();
		        		}

		        		// $message .= '<div style="color:red">- Data Matkul berikut belum ada di master matkul: '.$kode_mk.' '.$nama_mk.'. Silakan hubungi ust Samsirin untuk input manual</div>';
		        		// continue;
		        	}
		        	
		        	$dosen = Masterdosen::model()->findByAttributes(array('niy'=>$kode_dosen));
		        	if(empty($dosen))
		        	{
		        		$isnew = Masterdosen::model()->quickCreate($fakultas, $prodi, $kode_dosen, $nama_dosen);
		        		
		        		if(!$isnew)
		        		{

		        			$message .= '<div style="color:red">Wrong data dosen</div>';
		        				continue;
			        		$m->addError('error','Terjadi kesalahan input data dosen');
							throw new Exception();
		        		}

		        		
		        	}
		        	$kd_ruangan = $sheet->getCell('H'.$row);
		        	
		        	$nama_fakultas = $sheet->getCell('J'.$row);
		        	
		        	$nama_prodi = $sheet->getCell('L'.$row);
		        	
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

					$isconflict = Jadwal::model()->isConflict($kode_dosen, $hari,$jam_mulai);

					$m->bentrok = $isconflict;

					$m->kode_mk = $kode_mk;
					$m->nama_mk = $nama_mk;
					$m->kode_dosen = $kode_dosen;
					$m->nama_dosen = $nama_dosen;
					$m->semester = $semester;
					$m->kelas = $id_kelas;
					
					$mk = Mastermatakuliah::model()->findByAttributes(array('kode_mata_kuliah'=> $kode_mk));

					if(!empty($mk))
					{
						$mk->sks = $sks;
						$mk->save(false, array('sks'));
					}					
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
						$errors = 'Baris ke-';
						$errors .= ($index + 1).' : ';
						
						foreach($m->getErrors() as $attribute){
							foreach($attribute as $error){
								$errors .= $error.' <br>';
							}
						}
						
						$m->addError('error',$errors);
						throw new Exception();
					}
					
					$index++;
		        }

		        // $message .= '</ul>';
		        // $this->redirect(array('trRawatInap/lainnya','id'=>$id));
		        $transaction->commit();

		        if(!empty($message))
		        	$message = '<strong style="color:red">Catatan</strong><div style="color:orange">Sebagian data sukses terunggah. Ada beberapa belum, yaitu:</div>'.$message;
		        // $message = empty($message) ? ' Namun, '.$message : '';
		        Yii::app()->user->setFlash('success', "Data Jadwal telah diunggah.".$message);
				$this->redirect(array('index'));
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
		   'Kelas',
		   'SKS',
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
			$jam_ke = Jam::model()->findByPk($_POST['Jadwal']['jam_ke']);
			$model->jam_mulai = substr($jam_ke->jam_mulai, 0, -3);;
			$model->jam_selesai = substr($jam_ke->jam_selesai, 0, -3);

			$isconflict = Jadwal::model()->isConflict($model->kode_dosen, $model->hari,$jam_ke->jam_mulai);

			$model->bentrok = $isconflict;

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

			$jam_ke = Jam::model()->findByPk($_POST['Jadwal']['jam_ke']);
			$model->jam_mulai = substr($jam_ke->jam_mulai, 0, -3);;
			$model->jam_selesai = substr($jam_ke->jam_selesai, 0, -3);

			$model->nama_fakultas = $fak->nama_fakultas;
			$model->nama_prodi = $prodi->nama_prodi;
			$model->nama_mk = $mk->nama_mata_kuliah;

			$isconflict = Jadwal::model()->isConflict($model->kode_dosen, $model->hari,$jam_ke->jam_mulai);

			$model->bentrok = $isconflict;

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
