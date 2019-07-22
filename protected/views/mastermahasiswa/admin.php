<?php
/* @var $this MastermahasiswaController */
/* @var $model Mastermahasiswa */

$this->breadcrumbs=array(
	'Mastermahasiswas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mastermahasiswa', 'url'=>array('index')),
	array('label'=>'Create Mastermahasiswa', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mastermahasiswa-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mahasiswa</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mastermahasiswa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'kode_fakultas',
		
		'nim_mhs',
		'nama_mahasiswa',
		'tempat_lahir',
		'tgl_lahir',
		'jenis_kelamin',
		'prodi.singkatan',
		'semester',
		
		'hp',
		'email',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),

	),
	'htmlOptions'=>array(
	    'class'=>'col-xs-12'
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
   				'firstPageCssClass'=>'btn btn-info btn-sm',
                'previousPageCssClass'=>'btn btn-info btn-sm',
                'nextPageCssClass'=>'btn btn-info btn-sm',        
                'lastPageCssClass'=>'btn btn-info btn-sm',
			    'hiddenPageCssClass'=>'disabled btn btn-info btn-sm',
			    'internalPageCssClass'=>'btn btn-default btn-sm',
			    'selectedPageCssClass'=>'selected btn btn-default btn-sm',
			    'maxButtonCount'=>5,
        ),

)); ?>
