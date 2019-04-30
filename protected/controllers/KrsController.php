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
				'actions'=>array('create','update','bulk','kartu','nilai'),
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

	public function actionNilai($prodi = '', $tahun_akademik = '', $kampus='', $xls = 0){
		$model = null;

		$result = [];
		if(!empty($prodi)){
			$model = Yii::app()->db->createCommand()
		    ->select('d.nama_dosen, d.nidn, p.nama_prodi, p.singkatan, j.kelas, j.semester, j.kode_mk, mk.nama_mata_kuliah as nama_mk')
		    ->from('simak_masterdosen d')
		    ->join('simak_jadwal j', 'j.kode_dosen=d.nidn')
		    ->join('simak_masterprogramstudi p', 'p.kode_prodi=d.kode_prodi')
		    ->join('simak_mastermatakuliah mk','mk.kode_mata_kuliah = j.kode_mk')
		    ->where('d.kode_prodi = :p1 AND j.tahun_akademik = :p2 AND j.kampus = :p3 AND mk.tahun_akademik = :p2;', [
				':p1' => $prodi,
				':p2' => $tahun_akademik,
				':p3' => $kampus
			])
			->order('d.nama_dosen')
		    ->queryAll();

		    foreach($model as $q => $m)
			{
				$m = (object) $m;


				$sql = 'SELECT func_count_input_nilai('.$tahun_akademik.',"'.$m->nidn.'",'.$kampus.') as hasil;';
				$tmp = Yii::app()->db->createCommand($sql)->queryRow();
			    
			    $result[] = [
					'nama' => $m->nama_dosen,
					'semester' => $m->semester,
					'kelas' => $m->kelas,
					'kode_mk' => $m->kode_mk,
					'nama_mk' => $m->nama_mk,
					'nidn' => $m->nidn,
					'prodi' => $m->singkatan,
					'count' => $tmp['hasil']
				];

			}
	
		}

		if($xls){
			$this->renderPartial('_tabel_nilai',array(
				'result'=>$result,
				'xls' => $xls
			));
		}

		else{
			$this->render('nilai',array(
				'result'=>$result,
				'xls' => $xls
			));
		}
	}

	public function actionKartu()
	{
		if(!empty($_POST['kode_prodi'])&& !empty($_POST['kode_kampus']))
		{

			$kode_prodi = $_POST['kode_prodi'];
			$kode_kampus = $_POST['kode_kampus'];
			$semester = $_POST['semester'];
			

			$prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$kode_prodi));
			$fakultas = Masterfakultas::model()->findByAttributes(array('kode_fakultas'=>$prodi->kode_fakultas));
			$kampus = Kampus::model()->findByAttributes(array('kode_kampus'=>$kode_kampus));
			$dekan = Masterdosen::model()->findByAttributes(array('nidn'=>$fakultas->pejabat));

			$thn = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));

			$listmhs = Yii::app()->db->createCommand()
		     ->select('*')
		     ->from('simak_mastermahasiswa m')
		     ->join('simak_datakrs d', 'd.mahasiswa=m.nim_mhs')
		     ->where('d.is_approved = 1 AND m.kode_prodi=:p1 AND d.tahun_akademik=:p2 AND kampus=:p3 AND d.semester=:p4',array(':p1'=>$kode_prodi,':p2'=>$thn->tahun_id,':p3'=>$kode_kampus, ':p4'=>$semester))
		     ->order('m.nim_mhs')
		     ->group('m.nim_mhs')
		     // ->limit(1)
		     ->queryAll();


		    if(empty($listmhs))
		    {
		    	Yii::app()->user->setFlash('success', "Tidak Ada Data Mahasiswa.");
		    	$this->redirect(array('kartu'));
		    }


		    $tanggal = date('d-m-Y');

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

			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'mm', 'A4', true, 'UTF-8');

			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetAutoPageBreak(TRUE,10);
			$this->layout = '';

			$q = $_POST['jenis'];
			$jenis = ($q == 'uts') ? 'TENGAH' : 'AKHIR';

			date_default_timezone_set('Asia/Jakarta');
			foreach($listmhs as $m)
			{

			  	$m = (object)$m;
	
				$pdf->AddPage();
				

				
				ob_start();	
				echo $this->renderPartial('print_kartu',array(
					'thn' => $thn,
					'mhs' => $m,
					'prodi' => $prodi,
					'tanggal' =>$tanggal,
					'fakultas'=>$fakultas,
					'kampus' =>$kampus,
					'dekan'=>$dekan,
					'jenis' => $jenis
				));
			
				
				$data = ob_get_clean();
				
				$pdf->writeHTML($data);

				$style = array(
				    'border' => false,
    				'padding' => 0,
				    'fgcolor' => array(0,0,0),
				    'bgcolor' => false, //array(255,255,255)
				);
				$tgl = date('Y-m-d H:i:s');

				$pdf->write2DBarcode($m->nim_mhs.'#'.$m->nama_mahasiswa.'#'.$tgl, 'QRCODE,Q', 20, 220, 30, 30, $style, 'N');
			}

			ob_end_clean();
			$pdf->Output('kartu_'.$kode_prodi.'.pdf');
			exit;
		}

		$this->render('kartu');
	}

	public function actionBulk()
	{
		if(!empty($_POST['angkatan']) && !empty($_POST['semester']) && !empty($_POST['tanggal']))
		{

			$angkatan = $_POST['angkatan'];
			$semester = $_POST['semester'];
			$tanggal = $_POST['tanggal'];
			$krs_khs = $_POST['krs_khs'];
			$tahun_akademik = $_POST['tahun_akademik'];
			$kp = '55601';

			if($angkatan == '352014')
			{
				if($semester > 6)
				{
					$this->redirect(array('bulk'));
				}
			}

			else if($angkatan == '362015')
			{
				if($semester > 4)
				{
					$this->redirect(array('bulk'));
				}
			}

			else if($angkatan == '372016')
			{
				if($semester > 2)
				{
					$this->redirect(array('bulk'));
				}
			}	


			$prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$kp));
			$kaprodi = Masterdosen::model()->findByAttributes(array('nidn'=>$prodi->nidn_ketua_prodi));
			$thn = Tahunakademik::model()->findByAttributes(array('tahun_id'=>$tahun_akademik));

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

			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'mm', 'A4', true, 'UTF-8');

			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetAutoPageBreak(TRUE,10);
			$this->layout = '';

			date_default_timezone_set('Asia/Jakarta');
			foreach($listmhs as $m)
			{

			  	$m = (object)$m;

			  	$ipk = Yii::app()->helper->calc_ipk($m->nim_mhs, $angkatan,$semester);

			  	$dosenPA = Masterdosen::model()->findByPk($m->nip_promotor);
				
				$pdf->AddPage();
				
				
				ob_start();	

				if($krs_khs == 'KRS')
				{
					echo $this->renderPartial('print_bulk',array(
						'thn' => $thn,
						'mhs' => $m,
						'dosenPA' => $dosenPA,
						'semester' => $semester,
						'tanggal' => $tanggal,
					));
				}

				else if($krs_khs == 'KHS')
				{
					echo $this->renderPartial('print_bulk_khs',array(
						'thn' => $thn,
						'mhs' => $m,
						'dosenPA' => $dosenPA,
						'semester' => $semester,
						'tanggal' => $tanggal,
						'kaprodi' => $kaprodi,
						'ipk' => $ipk
					));
				}
				
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
