<?php
/* @var $this MastermatakuliahController */
/* @var $model Mastermatakuliah */

$this->breadcrumbs=array(
	'Mastermatakuliahs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mastermatakuliah', 'url'=>array('index')),
	array('label'=>'Create Mastermatakuliah', 'url'=>array('create')),
	array('label'=>'View Mastermatakuliah', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mastermatakuliah', 'url'=>array('admin')),
);
?>

<h1>Update Mastermatakuliah <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>