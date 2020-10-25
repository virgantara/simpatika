 <?php
$this->breadcrumbs=array(
	array('name'=>'Masterprogramstudi','url'=>['index']),
	array('name'=>'Manage'),
);

?>
<h1>Manage Masterprogramstudi</h1>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search,#size').change(function(){
			$('#masterprogramstudi-grid').yiiGridView.update('masterprogramstudi-grid', {
			    url:'<?php echo Yii::app()->createUrl("Masterprogramstudi/index"); ?>&filter='+$('#search').val()+'&size='+$('#size').val()
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
                        <div class="pull-left"> <?php	echo CHtml::link('Tambah Baru',array('Masterprogramstudi/create'),['class'=>'btn btn-success']);
?></div>


                         <div class="pull-right">Data per halaman
                              <?php                            echo CHtml::dropDownList('Masterprogramstudi[PAGE_SIZE]',isset($_GET['size'])?$_GET['size']:'',[10=>10,50=>50,100=>100,],['id'=>'size']); 
                            ?> 
                             <?php        echo CHtml::textField('Masterprogramstudi[SEARCH]','',['placeholder'=>'Cari','id'=>'search']);
        ?> 	 </div>
                    
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'masterprogramstudi-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>[
	[
		'header'=>'No',
		'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
	],
		'kode_prodi',
		// 'kode_jenjang_studi',
		'gelar_lulusan',
		'nama_prodi',
		'nama_prodi_en',
		'gelar_lulusan_en',
		'gelar_lulusan_short',
		'singkatan',
		
		/*
		'semester_awal',
		'no_sk_dikti',
		'tgl_sk_dikti',
		'tgl_akhir_sk_dikti',
		'jml_sks_lulus',
		'kode_status',
		'tahun_semester_mulai',
		'email_prodi',
		'tgl_pendirian_program_studi',
		'no_sk_akreditasi',
		'tgl_sk_akreditasi',
		'tgl_akhir_sk_akreditasi',
		'kode_status_akreditasi',
		'frekuensi_kurikulum',
		'pelaksanaan_kurikulum',
		'nidn_ketua_prodi',
		'telp_ketua_prodi',
		'fax_prodi',
		'nama_operator',
		'hp_operator',
		'telepon_program_studi',
		'kode_feeder',
		*/
		[
			'class'=>'CButtonColumn',
		],
	],
	'htmlOptions'=>[
		'class'=>'table'
	],
	'pager'=>[
		'class'=>'SimplePager',
		'header'=>'',
		'firstPageLabel'=>'Pertama',
		'prevPageLabel'=>'Sebelumnya',
		'nextPageLabel'=>'Selanjutnya',
		'lastPageLabel'=>'Terakhir',
		'firstPageCssClass'=>'btn btn-info',
		'previousPageCssClass'=>'btn btn-info',
		'nextPageCssClass'=>'btn btn-info',
		'lastPageCssClass'=>'btn btn-info',
		'hiddenPageCssClass'=>'disabled',
		'internalPageCssClass'=>'btn btn-info',
		'selectedPageCssClass'=>'btn btn-sky',
		'maxButtonCount'=>5
	],
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

