<?php
/* @var $this DatakrsController */
/* @var $model Datakrs */

$this->breadcrumbs=array(
	array('name'=>'Datakrs','url'=>array('admin')),
	array('name'=>'Datakrs'),
);

$this->menu=array(
	array('label'=>'List Datakrs', 'url'=>array('index')),
	array('label'=>'Create Datakrs', 'url'=>array('create')),
	array('label'=>'Update Datakrs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Datakrs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Datakrs', 'url'=>array('admin')),
);
?>

<h1>View Datakrs #<?php echo $model->id; ?></h1>
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
		'kode_pt',
		'kode_fak',
		'kode_jenjang',
		'kode_jurusan',
		'kode_prodi',
		'kode_mk',
		'nama_mk',
		'sks',
		'mahasiswa',
		'kode_dosen',
		'namadosen',
		'semester',
		'kode_jadwal',
		'kelas',
		'harian',
		'normatif',
		'uts',
		'uas',
		'nilai_angka',
		'nilai_huruf',
		'bobot_nilai',
		'created_date',
		'tahun_akademik',
		'status',
		'semester_matakuliah',
		'status_publis',
		'jumlah_nilai',
		'status_krs',
		'lulus',
		'pindahan',
		'created',
		'is_approved',
		'sudah_ekd',
		'score_ekd',
		'updated_at',
	),
)); ?>
	</div>
</div>
