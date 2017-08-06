<?php
/* @var $this TahunakademikController */
/* @var $model Tahunakademik */

$this->breadcrumbs=array(
	'Tahunakademiks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Tahunakademik', 'url'=>array('index')),
	array('label'=>'Create Tahunakademik', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tahunakademik-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tahunakademiks</h1>

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
	'id'=>'tahunakademik-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'tahun_id',
		'tahun',
		'semester',
		'nama_tahun',
		'krs_mulai',
		/*
		'krs_selesai',
		'krs_online_mulai',
		'krs_online_selesai',
		'krs_ubah_mulai',
		'krs_ubah_selesai',
		'kss_cetak_mulai',
		'kss_cetak_selesai',
		'cuti',
		'mundur',
		'bayar_mulai',
		'bayar_selesai',
		'kuliah_mulai',
		'kuliah_selesai',
		'uts_mulai',
		'uts_selesai',
		'uas_mulai',
		'uas_selesai',
		'nilai',
		'akhir_kss',
		'proses_buka',
		'proses_ipk',
		'proses_tutup',
		'buka',
		'syarat_krs',
		'syarat_krs_ips',
		'cuti_selesai',
		'max_sks',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
