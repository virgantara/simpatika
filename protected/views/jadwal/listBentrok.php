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
	// array('label'=>'Template Jadwal', 'url'=>array('template')),
	array('label'=>'Upload Jadwal', 'url'=>array('uploadJadwal')),
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
<style type="text/css">
	.bentrok { 
	    background-color: orange; 
	}
</style>
<h1>Manage Jadwals</h1>


<?php 
 foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div style="color:green">' . $message . "</div>\n";
    }
    

echo CHtml::link('Cetak Jadwal Personal',array('jadwal/cetakPerDosen'));
?>

<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'jadwal-grid',
	'dataProvider'=>$model->searchBentrok(),
	'rowCssClassExpression' => '$data->bentrok == 1 ? "bentrok" : ""',
	'filter'=>$model,
	'columns'=>array(
		array(
			'header' => 'No',
			'value'	=> '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
 
		'hari',
		'jam_mulai',
		'jam_selesai',
		array(
			'header' => 'Kampus',
			'value' => '$data->kAMPUS->nama_kampus'
		),
		'prodi',
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
