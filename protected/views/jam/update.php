<?php
/* @var $this JamController */
/* @var $model Jam */

$this->breadcrumbs=array(
	'Jams'=>array('index'),
	$model->id_jam=>array('view','id'=>$model->id_jam),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jam', 'url'=>array('index')),
	array('label'=>'Create Jam', 'url'=>array('create')),
	array('label'=>'View Jam', 'url'=>array('view', 'id'=>$model->id_jam)),
	array('label'=>'Manage Jam', 'url'=>array('admin')),
);
?>

<h1>Update Jam <?php echo $model->id_jam; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>