<?php
/* @var $this MastermatakuliahController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mastermatakuliahs',
);

$this->menu=array(
	array('label'=>'Create Mastermatakuliah', 'url'=>array('create')),
	array('label'=>'Manage Mastermatakuliah', 'url'=>array('admin')),
);
?>

<h1>Mastermatakuliahs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
