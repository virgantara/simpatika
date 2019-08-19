 <?php
$this->breadcrumbs=array(
	array('name'=>'Datakrs','url'=>array('admin')),
	array('name'=>'Manage'),
);

?>
<h1>Manage Datakrs</h1>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search,#size').change(function(){
			$('#datakrs-grid').yiiGridView.update('datakrs-grid', {
			    url:'<?php echo Yii::app()->createUrl("Datakrs/admin"); ?>&filter='+$('#search').val()+'&size='+$('#size').val()
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
<div class="pull-left"> <?php	echo CHtml::link('Tambah Baru',['Datakrs/create'],['class'=>'btn btn-success']);
?></div>


                         <div class="pull-right">Data per halaman
                              <?php                            echo CHtml::dropDownList('Datakrs[PAGE_SIZE]',isset($_GET['size'])?$_GET['size']:'',[10=>10,50=>50,100=>100],['id'=>'size']); 
                            ?> 
                             <?php        echo CHtml::textField('Datakrs[SEARCH]','',['placeholder'=>'Cari','id'=>'search']);
        ?> 	 </div>
                    
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'datakrs-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
	array(
		'header'=>'No',
		'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
		),
		'id',
		'kode_pt',
		'kode_fak',
		'kode_jenjang',
		'kode_jurusan',
		'kode_prodi',
		/*
		'kode_mk',
		'nama_mk',
		'sks',
		'mahasiswa',
		'kode_dosen',
		'namadosen',
		'semester',
		'kode_jadwal',
		'kelas',
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
		'created',
		'is_approved',
		'sudah_ekd',
		'score_ekd',
		'updated_at',
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

