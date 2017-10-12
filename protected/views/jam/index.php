<?php
/* @var $this JamController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jams',
);

$this->menu=array(
	array('label'=>'Create Jam', 'url'=>array('create')),
	array('label'=>'Manage Jam', 'url'=>array('admin')),
);
?>

<h1>Jams</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
