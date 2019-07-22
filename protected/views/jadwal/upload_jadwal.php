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
<div class="row">
<ul>
	<li>

	Template Jadwal silakan unduh di 
	<?php echo CHtml::link('sini',array('jadwal/template'));?>

</li>
<li>
	Petunjuk Unggah Jadwal silakan lihat di 
	<?php echo CHtml::link('sini',array('jadwal/petunjuk'));?>
</li>
</div>
</ul>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,

	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class' => 'form-horizontal'
	),
)); ?>

	<?php

echo $form->error($m, 'error');
	 ?>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Masukkan Data Excel :</label>
		<div class="col-sm-9">
		<?php 
		
echo $form->fileField($model, 'uploadedFile',['class'=>'form-control']); 
echo $form->error($model, 'uploadedFile');

		?>
	</div>
	</div>

	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit">
            <i class="ace-icon glyphicon glyphicon-upload bigger-110"></i>
            Upload
          </button>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
