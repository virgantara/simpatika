<?php
/* @var $this KampusController */
/* @var $model Kampus */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kampus-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,'<div class="alert alert-danger">Silakan perbaiki beberapa kesalahan berikut:','</div>'); ?>
	<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="alert alert-success">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php endif?>
	<div class="form-group">
		<label class = 'col-sm-3 control-label no-padding-right'>Jadwal</label>
		<div class="col-sm-9">
		<?php
		  $this->widget('zii.widgets.jui.CJuiDatePicker',array(
          'model' => $model,
          'attribute' => 'value',
          'options'=>array(
              'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
              'showOtherMonths'=>true,// Show Other month in jquery
              'selectOtherMonths'=>true,// Select Other month in jquery
               'dateFormat'=>'dd/mm/yy',
                'changeMonth' => true,
                'changeYear' => true,
          ),
          'htmlOptions'=>array(
              'style'=>''
          ),
      ));
		 // echo $form->textField($model,'value',array('size'=>60,'maxlength'=>100)); 
		 ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
	</div>

	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Simpan
          </button>
	  </div>
      </div>
             

<?php $this->endWidget(); ?>
