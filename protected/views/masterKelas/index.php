<?php
/* @var $this MasterKelasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Master Kelases',
);

$this->menu=array(
	array('label'=>'Create MasterKelas', 'url'=>array('create')),
	array('label'=>'Manage MasterKelas', 'url'=>array('admin')),
);
?>

<h1>Master Kelases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
