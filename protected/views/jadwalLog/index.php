<?php
/* @var $this JadwalLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jadwal Logs',
);

$this->menu=array(
	array('label'=>'Create JadwalLog', 'url'=>array('create')),
	array('label'=>'Manage JadwalLog', 'url'=>array('admin')),
);
?>

<h1>Jadwal Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
