<?php
/* @var $this JadwalLogController */
/* @var $model JadwalLog */

$this->breadcrumbs=array(
	'Jadwal Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JadwalLog', 'url'=>array('index')),
	array('label'=>'Create JadwalLog', 'url'=>array('create')),
	array('label'=>'Update JadwalLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JadwalLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JadwalLog', 'url'=>array('admin')),
);
?>

<h1>View JadwalLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'hari',
		'jam_ke',
		'jam',
		'jam_mulai',
		'jam_selesai',
		'kode_mk',
		'nama_mk',
		'kode_dosen',
		'nama_dosen',
		'semester',
		'kelas',
		'fakultas',
		'nama_fakultas',
		'prodi',
		'nama_prodi',
		'kd_ruangan',
		'tahun_akademik',
		'kuota_kelas',
		'kampus',
		'presensi',
		'materi',
		'bobot_formatif',
		'bobot_uts',
		'bobot_uas',
		'bobot_harian1',
		'bobot_harian',
		'bentrok',
		'bentrok_with',
		'created',
		'modified',
	),
)); ?>
