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

<script type="text/javascript">
    
	function updateData(){
		 $('#masterdosen-grid').yiiGridView.update('masterdosen-grid', {
            url:'?r=masterdosen/admin&filter='+$('#search').val()+'&size='+$('#size').val()+'&kode_prodi='+$('#kode_prodi').val()   
        });
	}

    $(document).ready(function(){
        $('#search, #size, #kode_prodi').change(function(){
           	updateData();
        });

        $('#pencarian').click(function(){
           	updateData();
        });
    });
</script>
 <div class="pull-right">
Data per halaman
<?php echo CHtml::dropDownList('Masterdosen[PAGE_SIZE]',isset($_GET['size'])?$_GET['size']:'',array(50=>50,100=>100,200=>200),array('id'=>'size','size'=>1)); ?>
Prodi
<?php 
$list_gol = CHtml::listData(Masterprogramstudi::model()->findAll(),'kode_prodi','nama_prodi');
echo CHtml::dropDownList('Masterdosen[KODEPRODI]',isset($_GET['kode_prodi'])?$_GET['kode_prodi']:'',$list_gol,array('id'=>'kode_prodi','empty' => 'Semua')); ?>  
<?php
echo CHtml::textField('Masterdosen[SEARCH]','',array('placeholder'=>'Cari','id'=>'search')); 
?>   
<?php
echo CHtml::button("Cari",array("id"=>"pencarian"));
?>
</div> 
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'masterdosen-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
			'header' => 'No',
			'value'	=> '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
		'kode_prodi',
		'nidn',
		'niy',
		'nama_dosen',
		
		/*
		'no_ktp_dosen',
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
