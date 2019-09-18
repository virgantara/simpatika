
<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'method' => 'get',
	'htmlOptions'=>array(
		'class'=>'form-horizontal'
	),
	'action' => $this->createUrl('jadwal/syncJadwal'),
)); 
?>


	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Tahun Akademik</label>
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(array('order'=>'tahun_id DESC')), 'tahun_id', function($dsn) {
		    return ($dsn->tahun_id);
		});
		?>
		<div class="col-sm-9">
		<?php
		echo CHtml::dropDownList('tahun_akademik','',$list); 
		// echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>


	
	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Sync Now
          </button>
	  </div>
      </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


