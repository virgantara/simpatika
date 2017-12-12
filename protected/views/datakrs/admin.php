<?php
/* @var $this DatakrsController */
/* @var $model Datakrs */

$this->breadcrumbs=array(
	'Datakrs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Datakrs', 'url'=>array('index')),
	array('label'=>'Create Datakrs', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#datakrs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Datakrs</h1>

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
	'id'=>'datakrs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'kode_fak',
		'kode_prodi',
		
		'kode_mk',
		'nama_mk',
		
		'mahasiswa',
		'kode_dosen',
		// 'namadosen',
		'semester',
		'kode_jadwal',
		'kelas',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
