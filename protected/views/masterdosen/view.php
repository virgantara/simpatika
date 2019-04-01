<?php
/* @var $this MasterdosenController */
/* @var $model Masterdosen */

$this->breadcrumbs=array(
	'Masterdosens'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Masterdosen', 'url'=>array('index')),
	array('label'=>'Create Masterdosen', 'url'=>array('create')),
	array('label'=>'Update Masterdosen', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Masterdosen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Masterdosen', 'url'=>array('admin')),
);
?>

<h1>View Masterdosen #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kode_pt',
		'kode_fakultas',
		'kode_jurusan',
		'kode_prodi',
		'kode_jenjang_studi',
		'no_ktp_dosen',
		'nidn',
		'niy',
		'nama_dosen',
		'gelar_depan',
		'gelar_akademik',
		'tempat_lahir_dosen',
		'tgl_lahir_dosen',
		'jenis_kelamin',
		'kode_jabatan_akademik',
		'kode_pendidikan_tertinggi',
		'kode_status_kerja_pts',
		'kode_status_aktivitas_dosen',
		'tahun_semester',
		'nip_pns',
		'home_base',
		'photo_dosen',
		'no_telp_dosen',
		'no_hp_dosen',
		'email_dosen',
		'alamat_dosen',
		'alamat_domisili',
		'kabupaten_dosen',
		'provinsi_dosen',
		'agama_dosen',
	),
)); ?>
