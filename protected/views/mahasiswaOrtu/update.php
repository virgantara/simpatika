<?php
/* @var $this MahasiswaOrtuController */
/* @var $model MahasiswaOrtu */

$this->breadcrumbs=array(
	'Mahasiswa Ortus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MahasiswaOrtu', 'url'=>array('index')),
	array('label'=>'Create MahasiswaOrtu', 'url'=>array('create')),
	array('label'=>'View MahasiswaOrtu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MahasiswaOrtu', 'url'=>array('admin')),
);
?>

<h1>Update MahasiswaOrtu <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'list_agama' => $list_agama,
	'list_pendidikan' => $list_pendidikan,
	'list_pekerjaan'=>$list_pekerjaan,
	'list_penghasilan' => $list_penghasilan,
	'list_keadaan' => $list_keadaan,
	'kampus' => $kampus,
	'kode_prodi' => $kode_prodi,
	'ta_masuk' => $ta_masuk,
	'tgl_masuk' => $tgl_masuk
)); ?>