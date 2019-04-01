<?php
/* @var $this JadwalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jadwals',
);

$this->menu=array(
	array('label'=>'Create Jadwal', 'url'=>array('create')),
	array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>

<h1>Jadwals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
