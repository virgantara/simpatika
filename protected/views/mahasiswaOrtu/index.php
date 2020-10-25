<?php
/* @var $this MahasiswaOrtuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mahasiswa Ortus',
);

$this->menu=array(
	array('label'=>'Create MahasiswaOrtu', 'url'=>array('create')),
	array('label'=>'Manage MahasiswaOrtu', 'url'=>array('admin')),
);
?>

<h1>Mahasiswa Ortus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
