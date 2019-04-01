<?php
/* @var $this TahunakademikController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tahunakademiks',
);

$this->menu=array(
	array('label'=>'Create Tahunakademik', 'url'=>array('create')),
	array('label'=>'Manage Tahunakademik', 'url'=>array('admin')),
);
?>

<h1>Tahunakademiks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
