<?php
/* @var $this KampusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kampuses',
);

$this->menu=array(
	array('label'=>'Create Kampus', 'url'=>array('create')),
	array('label'=>'Manage Kampus', 'url'=>array('admin')),
);
?>

<h1>Kampuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
