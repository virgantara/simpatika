<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
);

$this->menu=array(
	// array('label'=>'List Jadwal', 'url'=>array('index')),
	// array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>

<div class="form">
	<h4>Catatan:</h4>
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
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,

	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php

echo $form->error($m, 'error');
	 ?>
	<div class="row">
		<b>Masukkan Data Excel :</b>
		<?php 
		
echo $form->fileField($model, 'uploadedFile');
echo $form->error($model, 'uploadedFile');

		?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Upload'); ?>
		

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
