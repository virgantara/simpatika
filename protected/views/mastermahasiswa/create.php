<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */

$this->breadcrumbs=array(
	'Mastermahasiswas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mastermahasiswa', 'url'=>array('index')),
	array('label'=>'Manage Mastermahasiswa', 'url'=>array('admin')),
);
?>

<h1>Create Mastermahasiswa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>