<?php
/* @var $this MahasiswaOrtuController */
/* @var $model MahasiswaOrtu */

$this->breadcrumbs=array(
	'Mahasiswa Ortus'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MahasiswaOrtu', 'url'=>array('index')),
	array('label'=>'Create MahasiswaOrtu', 'url'=>array('create')),
	array('label'=>'Update MahasiswaOrtu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MahasiswaOrtu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MahasiswaOrtu', 'url'=>array('admin')),
);
?>

<h1>View MahasiswaOrtu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nim',
		'hubungan',
		'nama',
		'agama',
		'pendidikan',
		'pekerjaan',
		'penghasilan',
		'hidup',
		'alamat',
		'kota',
		'propinsi',
		'negara',
		'pos',
		'telepon',
		'hp',
		'email',
	),
)); ?>
