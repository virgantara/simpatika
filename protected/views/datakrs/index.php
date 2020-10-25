 <?php
$this->breadcrumbs=array(
	array('name'=>'Datakrs','url'=>['index']),
	array('name'=>'Manage'),
);

?>
<h1>Manage Datakrs</h1>

<div class="row">
    <div class="col-xs-12">
        
            <?php    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>
                        <div class="pull-left"> <?php	echo CHtml::link('Tambah Baru',array('Datakrs/create'),['class'=>'btn btn-success']);
?></div>


                         <div class="pull-right">Data per halaman
                              <?php                            echo CHtml::dropDownList('Datakrs[PAGE_SIZE]',isset($_GET['size'])?$_GET['size']:'',[10=>10,50=>50,100=>100,],['id'=>'size']); 
                            ?> 
                             <?php        echo CHtml::textField('Datakrs[SEARCH]','',['placeholder'=>'Cari','id'=>'search']);
        ?> 	 </div>
                    
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'datakrs-grid',
	'dataProvider'=>$model->search(),
	'filter' => $model,
	'columns'=>[
	[
		'header'=>'No',
		'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
	],
		
		'kode_mk',
		'nama_mk',
		'sks',
		'mahasiswa',
		'kode_dosen',
		'namadosen',
		'semester',
		'tahun_akademik',
		
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#search,#size').change(function(){
			$('#datakrs-grid').yiiGridView.update('datakrs-grid', {
			    url:'<?php echo Yii::app()->createUrl("Datakrs/index"); ?>&filter='+$('#search').val()+'&size='+$('#size').val()
			});
		});
		
	});
</script>
