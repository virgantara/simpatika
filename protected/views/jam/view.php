<?php
/* @var $this JamController */
/* @var $model Jam */

$this->breadcrumbs=array(
	'Jams'=>array('index'),
	$model->id_jam,
);

$this->menu=array(
	array('label'=>'List Jam', 'url'=>array('index')),
	array('label'=>'Create Jam', 'url'=>array('create')),
	array('label'=>'Update Jam', 'url'=>array('update', 'id'=>$model->id_jam)),
	array('label'=>'Delete Jam', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_jam),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Jam', 'url'=>array('admin')),
);
?>

<h1>View Jam #<?php echo $model->id_jam; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nama_jam',
		'jam_mulai',
		'jam_selesai',
		'id_jam',
	),
)); ?>
