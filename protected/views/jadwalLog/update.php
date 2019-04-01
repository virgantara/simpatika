<?php
/* @var $this JadwalLogController */
/* @var $model JadwalLog */

$this->breadcrumbs=array(
	'Jadwal Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JadwalLog', 'url'=>array('index')),
	array('label'=>'Create JadwalLog', 'url'=>array('create')),
	array('label'=>'View JadwalLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JadwalLog', 'url'=>array('admin')),
);
?>

<h1>Update JadwalLog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>