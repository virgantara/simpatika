<?php
/* @var $this MastermahasiswaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mastermahasiswas',
);

$this->menu=array(
	array('label'=>'Create Mastermahasiswa', 'url'=>array('create')),
	array('label'=>'Manage Mastermahasiswa', 'url'=>array('admin')),
);
?>

<h1>Mastermahasiswas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
