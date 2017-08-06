<?php
/* @var $this MasterKelasController */
/* @var $model MasterKelas */

$this->breadcrumbs=array(
	'Master Kelases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MasterKelas', 'url'=>array('index')),
	array('label'=>'Create MasterKelas', 'url'=>array('create')),
	array('label'=>'View MasterKelas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MasterKelas', 'url'=>array('admin')),
);
?>

<h1>Update MasterKelas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>