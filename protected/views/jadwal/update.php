<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jadwal', 'url'=>array('index')),
	array('label'=>'Create Jadwal', 'url'=>array('create')),
	array('label'=>'View Jadwal', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>

<h1>Update Jadwal <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>