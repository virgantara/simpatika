<?php
/* @var $this MasterdosenController */
/* @var $model Masterdosen */

$this->breadcrumbs=array(
	'Masterdosens'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Masterdosen', 'url'=>array('index')),
	array('label'=>'Create Masterdosen', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#masterdosen-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Masterdosens</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'masterdosen-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'kode_pt',
		'kode_fakultas',
		'kode_jurusan',
		'kode_prodi',
		'kode_jenjang_studi',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
