<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */

$this->breadcrumbs=array(
	'Mastermahasiswas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mastermahasiswa', 'url'=>array('index')),
	array('label'=>'Create Mastermahasiswa', 'url'=>array('create')),
	array('label'=>'View Mastermahasiswa', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mastermahasiswa', 'url'=>array('admin')),
);
?>

<h1>Update Mastermahasiswa <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>