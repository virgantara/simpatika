<?php
/* @var $this MahasiswaOrtuController */
/* @var $model MahasiswaOrtu */

$this->breadcrumbs=array(
	'Mahasiswa Ortus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MahasiswaOrtu', 'url'=>array('index')),
	array('label'=>'Manage MahasiswaOrtu', 'url'=>array('admin')),
);
?>

<h1>Create MahasiswaOrtu</h1>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'list_agama' => $list_agama,
	'list_pendidikan' => $list_pendidikan,
	'list_pekerjaan'=>$list_pekerjaan,
	'list_penghasilan' => $list_penghasilan,
	'list_keadaan' => $list_keadaan
)); ?>