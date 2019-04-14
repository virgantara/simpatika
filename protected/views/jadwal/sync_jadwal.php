<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui-timepicker-addon.min.css"> 


<div id="info" style="display:none;background-color: #FE9A2E;color:black;padding:5px 8px">
	
</div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'method' => 'get',
	'action' => $this->createUrl('jadwal/syncJadwal'),
)); 
?>


	<div class="row">
		<label>Tahun Akademik</label>
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(array('order'=>'tahun_id DESC')), 'tahun_id', function($dsn) {
		    return ($dsn->tahun_id);
		});
		echo CHtml::dropDownList('tahun_akademik','',$list); 
		// echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); 
		?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Sync Jadwal'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>


<script type="text/javascript">


	$(document).ready(function(){




	});
</script>