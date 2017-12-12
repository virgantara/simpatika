<?php
/* @var $this DatakrsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Datakrs',
);

$this->menu=array(
	array('label'=>'Create Datakrs', 'url'=>array('create')),
	array('label'=>'Manage Datakrs', 'url'=>array('admin')),
);
?>

<h1>Datakrs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
