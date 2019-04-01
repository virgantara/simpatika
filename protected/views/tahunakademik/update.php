<?php
/* @var $this TahunakademikController */
/* @var $model Tahunakademik */

$this->breadcrumbs=array(
	'Tahunakademiks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tahunakademik', 'url'=>array('index')),
	array('label'=>'Create Tahunakademik', 'url'=>array('create')),
	array('label'=>'View Tahunakademik', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tahunakademik', 'url'=>array('admin')),
);
?>

<h1>Update Tahunakademik <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>