<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Beranda</h1>


<ul>
	<li>
<div class="row">
	Template Jadwal silakan unduh di 
	<?php echo CHtml::link('sini',array('jadwal/template'));?>
</div>
</li>
<li>
<div class="row">
	Petunjuk Unggah Jadwal silakan lihat di 
	<?php echo CHtml::link('sini',array('jadwal/petunjuk'));?>
</div></li>
</ul>