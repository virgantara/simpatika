<?php
/* @var $this MasterprogramstudiController */
/* @var $model Masterprogramstudi */

$this->breadcrumbs=array(
	array('name'=>'Masterprogramstudi','url'=>array('admin')),
	array('name'=>'Masterprogramstudi'),
);

$this->menu=array(
	array('label'=>'List Masterprogramstudi', 'url'=>array('index')),
	array('label'=>'Create Masterprogramstudi', 'url'=>array('create')),
	array('label'=>'Update Masterprogramstudi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Masterprogramstudi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Masterprogramstudi', 'url'=>array('admin')),
);
?>

<h1>View Masterprogramstudi #<?php echo $model->id; ?></h1>
 <?php    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class="row">
	<div class="col-xs-12">
		
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kode_fakultas',
		'kode_jurusan',
		'kode_prodi',
		'kode_jenjang_studi',
		'gelar_lulusan',
		'gelar_lulusan_en',
		'gelar_lulusan_short',
		'nama_prodi',
		'nama_prodi_en',
		'semester_awal',
		'no_sk_dikti',
		'tgl_sk_dikti',
		'tgl_akhir_sk_dikti',
		'jml_sks_lulus',
		'kode_status',
		'tahun_semester_mulai',
		'email_prodi',
		'tgl_pendirian_program_studi',
		'no_sk_akreditasi',
		'tgl_sk_akreditasi',
		'tgl_akhir_sk_akreditasi',
		'kode_status_akreditasi',
		'frekuensi_kurikulum',
		'pelaksanaan_kurikulum',
		'nidn_ketua_prodi',
		'telp_ketua_prodi',
		'fax_prodi',
		'nama_operator',
		'hp_operator',
		'telepon_program_studi',
		'singkatan',
		'kode_feeder',
	),
)); ?>
	</div>
</div>
