<?php
/* @var $this MahasiswaOrtuController */
/* @var $model MahasiswaOrtu */

$this->breadcrumbs=array(
	'Mahasiswa Ortus'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MahasiswaOrtu', 'url'=>array('index')),
	array('label'=>'Create MahasiswaOrtu', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mahasiswa-ortu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Data Ortu</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mahasiswa-ortu-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		// 'id',
		'nim',
		'hubungan',
		'nama',
		'agama',
		'pendidikan',
		'pekerjaan',
		'penghasilan',
		'hidup',
		'alamat',
		'kota',
		'propinsi',
		'negara',
		'telepon',
		'hp',
		'email',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
	'itemsCssClass'=>'table table-bordered table-hover table-striped',
                'summaryCssClass'=>'table-message-info',
                'filterCssClass'=>'filter',
                'summaryText'=>'showing {start} - {end} from {count} data',
                'template'=>'{items}{summary}{pager}',
                'emptyText'=>'Data tidak ditemukan',
                'pagerCssClass'=>'pagination',
	'pager'=>array(

                'firstPageLabel'=>'First',
                'prevPageLabel'=>'Prev',
                'nextPageLabel'=>'Next',        
                'lastPageLabel'=>'Last',  
   				'firstPageCssClass'=>'',
                'previousPageCssClass'=>'',
                'nextPageCssClass'=>'',        
                'lastPageCssClass'=>'',
			    'hiddenPageCssClass'=>'disabled',
			    'internalPageCssClass'=>'',
			    'selectedPageCssClass'=>'selected',
			    'maxButtonCount'=>5,
        ),

)); ?>
