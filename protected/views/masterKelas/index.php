<?php
/* @var $this MasterkelasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Masterkelases',
);

$this->menu=array(
	array('label'=>'Create Masterkelas', 'url'=>array('create')),
	array('label'=>'Manage Masterkelas', 'url'=>array('admin')),
);
?>

<h1>Masterkelases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
