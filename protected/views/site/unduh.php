<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Unduhan</h1>
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Home';
$this->breadcrumbs=array(
	'Home',
);
?>
<div class="row">
	<div class="col-xs-12">
<ul class="list-group">
	<li class="list-group-item">
	Template Jadwal silakan unduh di 
	<?php echo CHtml::link('sini',array('jadwal/template'));?>

</li>
<li class="list-group-item">

	Petunjuk Unggah Jadwal silakan lihat di 
	<?php echo CHtml::link('sini',array('jadwal/petunjuk'));?>
</li>
<li class="list-group-item">

	Data Dosen 
	<?php echo CHtml::link('sini',array('masterdosen/unduhDataDosen'));?>
</li>
</ul>
</div>
</div>