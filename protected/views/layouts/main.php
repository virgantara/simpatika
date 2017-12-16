<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/home'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Jadwal', 'url'=>array('/jadwal/index'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Rekap Jadwal Per Prodi', 'url'=>array('/jadwal/rekapJadwal'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Unggah Jadwal', 'url'=>array('/jadwal/uploadJadwal'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),

				array('label'=>'Cetak Jadwal Personal', 'url'=>array('/jadwal/cetakPerDosen'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Cetak Jadwal Personal All', 'url'=>array('/jadwal/cetakPersonalAll'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Cetak Lampiran SK', 'url'=>array('/jadwal/cetakLampiran'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				
				array('label'=>'Rekap Jadwal Per Prodi', 'url'=>array('/jadwal/rekapJadwal'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Rekap Jadwal Semua Dosen', 'url'=>array('/jadwal/rekapJadwalAll'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				array('label'=>'Rekap Jadwal Bentrok', 'url'=>array('/jadwal/rekapJadwalBentrok'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				
				array('label'=>'Master', 'url'=>array('/site/master'),'visible'=>Yii::app()->user->checkAccess(array(WebUser::R_SA))),
				
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Head Office : Main Campus University of Darussalam Gontor Demangan Siman Ponorogo East Java Indonesia 63471<br>
Phone : (+62352) 483762, Fax : (+62352) 488182, Email : rektorat@unida.gontor.ac.id
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
