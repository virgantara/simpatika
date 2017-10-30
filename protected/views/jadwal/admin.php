<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Cetak Jadwal Per Dosen', 'url'=>array('cetakPerDosen')),
	array('label'=>'List Jadwal', 'url'=>array('index')),
	array('label'=>'Create Jadwal', 'url'=>array('create')),
	array('label'=>'Template Jadwal', 'url'=>array('template')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#jadwal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jadwals</h1>

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

<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'jadwal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header' => 'No',
			'value'	=> '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
 
		'hari',
		array(
			'header' => 'Jam Mulai',
			'value' => '$data->jAM->jam_mulai'
		),
		array(
			'header' => 'Jam Selesai',
			'value' => '$data->jAM->jam_selesai'
		),
		array(
			'header' => 'Kampus',
			'value' => '$data->kAMPUS->nama_kampus'
		),
		'nama_prodi',
		'kode_mk',
		'nama_mk',
		// array(
		// 	'header' => 'Nama Mk',
		// 	'value' => '$data->matkul->nama_mata_kuliah'
		// ),
		'kode_dosen',
		'nama_dosen',
		'semester',

		
		array(
			'header' => 'Kelas',
			'value' => '$data->kELAS->nama_kelas'
		),
		array(
			'header' => 'SKS',
			'value' => '$data->SKS'
		),
		'kuota_kelas',
		/*
		'fakultas',
		'prodi',
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
	'pager'=>array(

                'firstPageLabel'=>'First',
                'prevPageLabel'=>'Prev',
                'nextPageLabel'=>'Next',        
                'lastPageLabel'=>'Last',  
   				'firstPageCssClass'=>'btn',
                'previousPageCssClass'=>'btn',
                'nextPageCssClass'=>'btn',        
                'lastPageCssClass'=>'btn',
			    'hiddenPageCssClass'=>'disabled',
			    'internalPageCssClass'=>'btn',
			    'selectedPageCssClass'=>'selected',
			    'maxButtonCount'=>5,
        ),

)); ?>
