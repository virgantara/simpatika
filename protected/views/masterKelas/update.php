<?php
/* @var $this MasterkelasController */
/* @var $model Masterkelas */

$this->breadcrumbs=array(
	'Masterkelases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Masterkelas', 'url'=>array('index')),
	array('label'=>'Create Masterkelas', 'url'=>array('create')),
	array('label'=>'View Masterkelas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Masterkelas', 'url'=>array('admin')),
);
?>

<h1>Update Masterkelas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>