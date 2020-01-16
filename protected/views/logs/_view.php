<?php
/* @var $this LogsController */
/* @var $data Logs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_log')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_log), array('view', 'id'=>$data->id_log)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>