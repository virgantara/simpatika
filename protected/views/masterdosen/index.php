<?php
/* @var $this MasterdosenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Masterdosens',
);

$this->menu=array(
	array('label'=>'Create Masterdosen', 'url'=>array('create')),
	array('label'=>'Manage Masterdosen', 'url'=>array('admin')),
);
?>

<h1>Masterdosens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
