<?php
/* @var $this MasterKelasController */
/* @var $model MasterKelas */

$this->breadcrumbs=array(
	'Master Kelases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MasterKelas', 'url'=>array('index')),
	array('label'=>'Create MasterKelas', 'url'=>array('create')),
	array('label'=>'Update MasterKelas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MasterKelas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MasterKelas', 'url'=>array('admin')),
);
?>

<h1>View MasterKelas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama_kelas',
	),
)); ?>
