<?php
/* @var $this MastermatakuliahController */
/* @var $model Mastermatakuliah */

$this->breadcrumbs=array(
	'Mastermatakuliahs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mastermatakuliah', 'url'=>array('index')),
	array('label'=>'Create Mastermatakuliah', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mastermatakuliah-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mastermatakuliahs</h1>

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
	'id'=>'mastermatakuliah-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header' => 'No',
			'value'	=> '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
		'tahun_akademik',
		
		'kode_fakultas',
		'kode_prodi',
		
		'kode_mata_kuliah',
		'nama_mata_kuliah',
		'sks',
		'semester',
		/*
		'sks_tatap_muka',
		'sks_praktikum',
		'sks_praktek_lap',
		'semester',
		'kode_kelompok',
		'kode_kurikulum',
		'kode_matkul',
		'nidn',
		'jenjang_prodi',
		'prodi_pengampu',
		'status_mata_kuliah',
		'silabus',
		'sap',
		'bahan_ajar',
		'diktat',
		'status_wajib',
		'sms',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
