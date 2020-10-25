 <?php
$this->breadcrumbs=array(
	array('name'=>'Masterdosen','url'=>array('admin')),
	array('name'=>'Manage'),
);

?>
<h1>Manage Masterdosen</h1>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search,#size').change(function(){
			$('#masterdosen-grid').yiiGridView.update('masterdosen-grid', {
			    url:'<?php echo Yii::app()->createUrl("Masterdosen/admin"); ?>&filter='+$('#search').val()+'&size='+$('#size').val()
			});
		});
		
	});
</script>
<div class="row">
    <div class="col-xs-12">
        
<?php    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class="pull-left"> <?php	echo CHtml::link('Tambah Baru',['Masterdosen/create'],['class'=>'btn btn-success']);
?></div>


                         <div class="pull-right">Data per halaman
                              <?php                            echo CHtml::dropDownList('Masterdosen[PAGE_SIZE]',isset($_GET['size'])?$_GET['size']:'',[10=>10,50=>50,100=>100],['id'=>'size']); 
                            ?> 
                             <?php        echo CHtml::textField('Masterdosen[SEARCH]','',['placeholder'=>'Cari','id'=>'search']);
        ?> 	 </div>
                    
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'masterdosen-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
	array(
		'header'=>'No',
		'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
		),
		
		'kode_fakultas',
		// 'kode_jurusan',
		'kode_prodi',
		'nidn',
		'niy',
		'nama_dosen',
		'email_dosen',
		/*
		'no_ktp_dosen',
		'nidn',
		'niy',
		
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
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
	'htmlOptions'=>array(
		'class'=>'table'
	),
	'pager'=>array(
		'class'=>'SimplePager',
		'header'=>'',
		'firstPageLabel'=>'Pertama',
		'prevPageLabel'=>'Sebelumnya',
		'nextPageLabel'=>'Selanjutnya',
		'lastPageLabel'=>'Terakhir',
		'firstPageCssClass'=>'btn btn-info btn-sm',
		'previousPageCssClass'=>'btn btn-info btn-sm',
		'nextPageCssClass'=>'btn btn-info btn-sm',
		'lastPageCssClass'=>'btn btn-info btn-sm',
		'hiddenPageCssClass'=>'disabled',
		'internalPageCssClass'=>'btn btn-info btn-sm',
		'selectedPageCssClass'=>'btn btn-sky btn-sm',
		'maxButtonCount'=>5
	),
	'itemsCssClass'=>'table  table-bordered table-hover',
	'summaryCssClass'=>'table-message-info',
	'filterCssClass'=>'filter',
	'summaryText'=>'menampilkan {start} - {end} dari {count} data',
	'template'=>'{items}{summary}{pager}',
	'emptyText'=>'Data tidak ditemukan',
	'pagerCssClass'=>'pagination pull-right no-margin',
)); ?>


	</div>
</div>

