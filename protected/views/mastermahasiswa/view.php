<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */

$this->breadcrumbs=array(
	'Mastermahasiswas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mastermahasiswa', 'url'=>array('index')),
	array('label'=>'Create Mastermahasiswa', 'url'=>array('create')),
	array('label'=>'Update Mastermahasiswa', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mastermahasiswa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mastermahasiswa', 'url'=>array('admin')),
);
?>

<h1>View Mastermahasiswa #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kode_pt',
		'kode_fakultas',
		'kode_prodi',
		'kode_jenjang_studi',
		'nim_mhs',
		'nama_mahasiswa',
		'tempat_lahir',
		'tgl_lahir',
		'jenis_kelamin',
		'tahun_masuk',
		'semester_awal',
		'batas_studi',
		'asal_propinsi',
		'tgl_masuk',
		'tgl_lulus',
		'status_aktivitas',
		'status_awal',
		'jml_sks_diakui',
		'nim_asal',
		'asal_pt',
		'nama_asal_pt',
		'asal_jenjang_studi',
		'asal_prodi',
		'kode_biaya_studi',
		'kode_pekerjaan',
		'tempat_kerja',
		'kode_pt_kerja',
		'kode_ps_kerja',
		'nip_promotor',
		'nip_co_promotor1',
		'nip_co_promotor2',
		'nip_co_promotor3',
		'nip_co_promotor4',
		'photo_mahasiswa',
		'semester',
		'keterangan',
		'status_bayar',
		'telepon',
		'hp',
		'email',
		'alamat',
		'berat',
		'tinggi',
		'ktp',
		'rt',
		'rw',
		'dusun',
		'kode_pos',
		'desa',
		'kecamatan',
		'jenis_tinggal',
		'penerima_kps',
		'no_kps',
		'provinsi',
		'kabupaten',
		'warga_negara',
		'status_sipil',
		'agama',
		'gol_darah',
		'masuk_kelas',
		'tgl_sk_yudisium',
		'status_mahasiswa',
		'kampus',
	),
)); ?>