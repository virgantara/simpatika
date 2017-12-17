<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'PA'=>array('index'),
);

?>

<div class="form">
	<h4>Catatan:</h4>
<ul>
	<li>
<div class="row">
	Template PA silakan unduh di 
	<?php echo CHtml::link('sini',array('mastermahasiswa/templatePA'));?>
</div>
</li>
	<li>
<div class="row">
	Daftar Kode Dosen unduh di
	<?php echo CHtml::link('sini',array('masterdosen/unduhDataDosen'));?>
</div>
</li>

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
 foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div style="color:green">' . $message . "</div>\n";
    }
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
