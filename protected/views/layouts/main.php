<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/bootstrap/css/bootstrap.min.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/bootstrap/js/bootstrap.min.js"></script>


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
				array('label'=>'Home', 'url'=>array('/site/home'),'visible'=>!Yii::app()->user->isGuest),
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
				
				array('label'=>'Catatan Revisi', 'url'=>array('/jadwalLog/admin'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				
				array('label'=>'Data Belum Input Nilai', 'url'=>array('/krs/nilai'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Master', 'url'=>array('/site/master'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Biodata Mahasiswa', 'url'=>array('/mastermahasiswa/dataortu'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				// array('label'=>'Log', 'url'=>array('/logs/admin'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				// array('label'=>'Foto', 'url'=>array('/utils/foto'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),


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

	<footer>
		Head Office : Main Campus University of Darussalam Gontor Demangan Siman Ponorogo East Java Indonesia 63471<br>
Phone : (+62352) 483762, Fax : (+62352) 488182, Email : rektorat@unida.gontor.ac.id
	</footer><!-- footer -->
</div>
</body>
</html>
