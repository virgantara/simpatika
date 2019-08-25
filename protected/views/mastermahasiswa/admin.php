 <?php
$this->breadcrumbs=array(
	array('name'=>'Mastermahasiswa','url'=>array('admin')),
	array('name'=>'Manage'),
);

?>
<h1>Manage Mastermahasiswa</h1>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search,#size').change(function(){
			$('#mastermahasiswa-grid').yiiGridView.update('mastermahasiswa-grid', {
			    url:'<?php echo Yii::app()->createUrl("Mastermahasiswa/admin"); ?>&filter='+$('#search').val()+'&size='+$('#size').val()
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
<div class="pull-left"> <?php	echo CHtml::link('Tambah Baru',['Mastermahasiswa/create'],['class'=>'btn btn-success']);
?></div>


                         <div class="pull-right">Data per halaman
                              <?php                            echo CHtml::dropDownList('Mastermahasiswa[PAGE_SIZE]',isset($_GET['size'])?$_GET['size']:'',[10=>10,50=>50,100=>100],['id'=>'size']); 
                            ?> 
                             <?php        echo CHtml::textField('Mastermahasiswa[SEARCH]','',['placeholder'=>'Cari','id'=>'search']);
        ?> 	 </div>
                    
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'mastermahasiswa-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
	array(
		'header'=>'No',
		'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
		),
		'kode_prodi',
		// 'kode_jenjang_studi',
		'nim_mhs',
		
		'nama_mahasiswa',
		'tempat_lahir',
		'tgl_lahir',
		'jenis_kelamin',
		// 'tahun_masuk',
		'hp',
		'email',
		'alamat',
		// 'kecamatan',
		// 'kecamatan_feeder',
		'provinsi',
		'kabupaten',
		'warga_negara',
		'va_code',
		'updated_at',
		'status_aktivitas',
		array(
			'class'=>'CButtonColumn',
			'template' => '{view} {update} {delete} {skpi}',
			'buttons' => array(
				
				// 'printPengantar' => array(
				// 	'url'=>'Yii::app()->createUrl("labRequest/cetakHasil/", array("id"=>$data->id))',   
				// 	'label'=>'<i class="fa fa-print"></i>',
				// 	'options' => array('title'=>'Cetak Hasil','class'=>'print'),      
	   //          ),
				'skpi' => array(
					'url'=>'Yii::app()->createUrl("mastermahasiswa/skpi/", ["id"=>$data->id])',   
					// 'label'=>'<i class="fa fa-magnifier"></i>',
					'options' => array('title'=>'View','class'=>'view'),      
	            ),
				

			),
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

