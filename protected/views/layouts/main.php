<?php /* @var $this Controller */ 
$cs = Yii::app()->getClientScript();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="google-signin-client_id" content="668363583558-r1pp6okdumpn0k8h5lmqrn7noutbu2lp.apps.googleusercontent.com">
		
   

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/bootstrap/css/bootstrap.min.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/bootstrap/js/bootstrap.min.js"></script>
<?php
$cs->registerCssFile(Yii::app()->baseUrl.'/node_modules/sweetalert2/dist/sweetalert2.min.css');
$cs->registerScriptFile(Yii::app()->baseUrl.'/node_modules/sweetalert2/dist/sweetalert2.all.min.js',CClientScript::POS_END);

$cs->registerCssFile(Yii::app()->baseUrl.'/node_modules/intro.js/minified/introjs.min.css');
$cs->registerScriptFile(Yii::app()->baseUrl.'/node_modules/intro.js/minified/intro.min.js',CClientScript::POS_END);
?>	
<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/css/main.css">   

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<nav class="navbar navbar-default navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array('class'=>'nav navbar-nav'),
	        'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),

	        // 'itemCssClass'=>'hover',
	        'encodeLabel'=>false,
			'items'=>array(
				['label'=>'Home', 'url'=>array('/site/index#slider-area')],
				[
					'label' => 'Petunjuk & Unduhan <span class="caret"></span>',
					'url' => '#',

					'itemOptions' => ['class'=>'dropdown-toggle'],
					'linkOptions' => ['class'=>'dropdown-toggle','data-toggle'=>"dropdown",'role' =>'button'],
					'items' => [
						array('label'=>'Penggunaan SIMPATIKA', 'url'=>'#'),
						array('label'=>'Alur SIMPATIKA', 'url'=>['site/index#flow']),
						array('label'=>'Template Jadwal', 'url'=>['site/unduh']),
						array('label'=>'Data Dosen', 'url'=>['masterdosen/unduhDataDosen']),
					]
				],
				['label'=>'Important Dates', 'url'=>array('/site/index#dates')],
				[
					'label' => 'Tentang SIMPATIKA',
					'url' => ['/site/about'],
					
				],
				array('label'=>'Jadwal', 'url'=>array('/jadwal/index'),'visible'=>!Yii::app()->user->isGuest),
				[
					'label' => 'Cetak <span class="caret"></span>',
					'url' => '#',
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions' => ['class'=>'dropdown-toggle'],
					'linkOptions' => ['class'=>'dropdown-toggle','data-toggle'=>"dropdown",'role' =>'button'],
					'items' => [
						array('label'=>'Cetak Bulk KRS', 'url'=>array('/krs/bulk'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Cetak Kartu Ujian', 'url'=>array('/krs/kartu'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
						array('label'=>'Cetak Jurnal', 'url'=>array('/jadwal/cetakJurnal'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
						array('label'=>'Cetak Jadwal Personal All', 'url'=>array('/jadwal/cetakPersonalAll'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
						array('label'=>'Cetak Lampiran SK', 'url'=>array('/jadwal/cetakLampiran'),'visible'=>!Yii::app()->user->isGuest),
					]
				],
				[
					'label' => 'Rekap <span class="caret"></span>',
					'url' => '#',
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions' => ['class'=>'dropdown-toggle'],
					'linkOptions' => ['class'=>'dropdown-toggle','data-toggle'=>"dropdown",'role' =>'button'],
					'items' => [
						array('label'=>'Rekap Jadwal Per Prodi', 'url'=>array('/jadwal/rekapJadwal'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Rekap Jadwal Semua Dosen', 'url'=>array('/jadwal/rekapJadwalAll'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Rekap Jadwal Bentrok', 'url'=>array('/jadwal/rekapJadwalBentrok'),'visible'=>!Yii::app()->user->isGuest),
					]
				],

				array('label'=>'Unggah Jadwal', 'url'=>array('/jadwal/uploadJadwal'),'visible'=>!Yii::app()->user->isGuest),
				
				// array('label'=>'Unggah PA', 'url'=>array('/mastermahasiswa/uploadPA'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Jadwal Personal', 'url'=>array('/jadwal/cetakPerDosen')),
				array(
					'label'=>'PA', 
					'itemOptions' => [
						'data-step'=>'1',
						'data-intro' => 'New Feature'
					],
					'url'=>array('/masterdosen/pa'),
					'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA,WebUser::R_PRODI,WebUser::R_BAAK))
				),
				array('label'=>'Catatan Revisi', 'url'=>array('/jadwalLog/admin'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Pencekalan', 'url'=>array('/pencekalan/index'),'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA,WebUser::R_BAAK, WebUser::R_AKPAM,WebUser::R_TAHFIDZ])),
				array('label'=>'Data Belum Input Nilai', 'url'=>array('/krs/nilai'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				[
					'label'=>'Laporan <span class="caret"></span>', 
					'url'=>'#',
					'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA,WebUser::R_BAAK,WebUser::R_PRODI]),
					'itemOptions' => ['class'=>'dropdown-toggle'],
					'linkOptions' => ['class'=>'dropdown-toggle','data-toggle'=>"dropdown",'role' =>'button'],
					'items' => [
						['label'=>'Laporan Input Nilai', 'url'=>['/krs/nilai'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Laporan Input EKD', 'url'=>['/krs/ekd'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA, WebUser::R_BAAK, WebUser::R_PRODI])],
						['label'=>'Mahasiswa Belum Lengkap Data Ortu', 'url'=>['/mastermahasiswa/dataortu'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Lampiran SK', 'url'=>array('/jadwalLampiranSk/admin'),'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
					]
				],
				[
					'label'=>'Master <span class="caret"></span>', 
					'url'=>'#',
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions' => ['class'=>'dropdown-toggle'],
					'linkOptions' => ['class'=>'dropdown-toggle','data-toggle'=>"dropdown",'role' =>'button'],
					'items' => [
						['label'=>'Upload Mahasiswa ke SIAKAD', 'url'=>['/mastermahasiswa/uploadMhs'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Sync Jadwal ke SIAKAD', 'url'=>['/jadwal/syncJadwal'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Prodi', 'url'=>['/masterprogramstudi/index'],'visible'=>!Yii::app()->user->isGuest],
						['label'=>'Mata Kuliah', 'url'=>['/mastermatakuliah/index'],'visible'=>!Yii::app()->user->isGuest],
						['label'=>'Kelas', 'url'=>['/masterkelas/index'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Kampus', 'url'=>['/kampus/index'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Tahun Akademik', 'url'=>['/tahunakademik/index'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Jam Mengajar', 'url'=>['/jam/index'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Mahasiswa', 'url'=>['/mastermahasiswa/admin'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Dosen', 'url'=>['/masterdosen/admin'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'User di SIAKAD', 'url'=>['/users/index'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'User SIMPATIKA', 'url'=>['/user/index'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
						['label'=>'Data KRS di SIAKAD', 'url'=>['/datakrs/index'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA, WebUser::R_NILAI])],
						['label'=>'TTD Rektor', 'url'=>['/utils/ttd'],'visible'=>Yii::app()->user->checkAccess([WebUser::R_SA])],
					]
				],
				array('label'=>'Biodata Mahasiswa', 'url'=>array('/mastermahasiswa/dataortu'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				// array('label'=>'Log', 'url'=>array('/logs/admin'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				// array('label'=>'Foto', 'url'=>array('/utils/foto'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array(
					'label'=>'Logout ('.Yii::app()->user->name.')',
					'url'=>'javascript:void(0)',

					// 'encodeLabel'=>false,

					// 'template' => '<a href="{url}" id="btn-logout">{label}</a>' ,
					'linkOptions' => ['id'=>'btn-logout'],
					'visible'=>!Yii::app()->user->isGuest),


			),
		)); ?>
	</div>
	</div>
	</nav><!-- mainmenu -->
      <div class="container-fluid">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<footer class='footer-content' style="bottom: 0;">
		Head Office : Main Campus University of Darussalam Gontor Demangan Siman Ponorogo East Java Indonesia 63471<br>
Phone : (+62352) 483762, Fax : (+62352) 488182, Email : rektorat@unida.gontor.ac.id
	</footer><!-- footer -->
</div>
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
 <script type="text/javascript">
		
	
	function onLoad() {
	  gapi.load('auth2', function() {
	    gapi.auth2.init();
	  });
	}

	function signOut() {
		var auth2 = gapi.auth2.getAuthInstance();
		// auth2.signOut();
		auth2.signOut().then(function () {
        	window.location = '<?=Yii::app()->createUrl('site/logout');?>';
        	// console.log('User signed out.');
      	});
		
	}


	$(document).ready(function(){
		<?php 
		if(Yii::app()->user->checkAccess(array(WebUser::R_SA,WebUser::R_PRODI,WebUser::R_BAAK)))
		{
		?>
		var introguide = introJs();
		introguide.setOptions({
			exitOnOverlayClick: false,
			doneLabel: "Klik di sini",

		});
		// introguide.start();
	    // // localStorage.clear();
	    var doneTour = localStorage.getItem('evt_menu_pa') === 'Completed';
	    
	    if(!doneTour) {
	        introguide.start()

	        introguide.oncomplete(function () {
	            localStorage.setItem('evt_menu_pa', 'Completed');
	            window.location.href = '<?=Yii::app()->createUrl('masterdosen/pa');?>';
	        });

	       
	    }
	    <?php 
			}
	    ?>
		$('#btn-logout').click(function(){	
	        signOut();
	    });
	});
</script>
</body>

</html>
   