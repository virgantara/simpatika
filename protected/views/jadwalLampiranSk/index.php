<?php
/* @var $this JadwalLampiranSkController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jadwal Lampiran Sks',
);

$this->menu=array(
	array('label'=>'Create JadwalLampiranSk', 'url'=>array('create')),
	array('label'=>'Manage JadwalLampiranSk', 'url'=>array('admin')),
);
?>

<h1>Jadwal Lampiran Sks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
