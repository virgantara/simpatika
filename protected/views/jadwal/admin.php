<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Preview Jadwal Peronal', 'url'=>array('previewJadwalPersonal')),
	array('label'=>'Cetak Jadwal Per Dosen', 'url'=>array('cetakPerDosen')),
	array('label'=>'List Jadwal', 'url'=>array('index')),
	array('label'=>'Create Jadwal', 'url'=>array('create')),
	// array('label'=>'Template Jadwal', 'url'=>array('template')),
	array('label'=>'Upload Jadwal', 'url'=>array('uploadJadwal')),
	array('label'=>'Ref Kode Dosen', 'url'=>array('refdosen')),
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


$setting = Settings::model()->findByAttributes(['name'=>'site.jadwal']);
$tgl_akhir = !empty($setting) ? $setting->value : date('Y-m-d',strtotime(' -1 days'));
?>
<style type="text/css">
	.bentrok { 
	    background-color: orange; 
	}
</style>
<h1>Manage Jadwals</h1>


<script type="text/javascript">
    
	function updateData(){
		 $('#jadwal-grid').yiiGridView.update('jadwal-grid', {
            url:'?r=jadwal/admin&filter='+$('#search').val()+'&size='+$('#size').val()+'&kode_prodi='+$('#kode_prodi').val()   
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
<?php 
 foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div style="color:green">' . $message . "</div>\n";
    }
  ?>
<div class="row">
	<div class="col-xs-12">
  <?php
echo '<ul>';
echo '<li>'.CHtml::link('Cetak Jadwal Personal',array('jadwal/cetakPerDosen'),array('target'=>'_blank')).'</li>';
echo '<li>'.CHtml::link('Rekap Jadwal Per Prodi',array('jadwal/rekapJadwal'),array('target'=>'_blank')).'</li>';
echo '<li>'.CHtml::link('Rekap Jadwal Semua Dosen',array('jadwal/rekapJadwalAll'),array('target'=>'_blank')).'</li>';
echo '</ul>';
?>

 <div class="pull-right">
Data per halaman
<?php echo CHtml::dropDownList('Jadwal[PAGESIZE]',isset($_GET['size'])?$_GET['size']:'',array(10=>10,50=>50,100=>100,200=>200),array('id'=>'size','size'=>1)); ?>
Prodi
<?php 
$list_gol = CHtml::listData(Jadwal::model()->findProdiInJadwal(),'kode_prodi','nama_prodi');
echo CHtml::dropDownList('Jadwal[KODEPRODI]',isset($_GET['kode_prodi'])?$_GET['kode_prodi']:'',$list_gol,array('id'=>'kode_prodi','empty' => 'Semua')); ?>  
<?php
echo CHtml::textField('Jadwal[SEARCH]','',array('placeholder'=>'Cari','id'=>'search')); 
?>   
<?php
echo CHtml::button("Cari",array("id"=>"pencarian"));
?>
</div> 
<?php
echo CHtml::button("Hapus Item Terpilih",array("id"=>"butt"));
?>
</div>
</div>
<div class="row">
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'jadwal-grid',
	'dataProvider'=>$model->search(),
	'rowCssClassExpression' => '$data->bentrok == 1 ? "bentrok" : ""',
	// 'filter'=>$model,
	'columns'=>array(
		array(
			'header' => 'No',
			'value'	=> '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
 
		'hari',
		'jam_ke',
		'jam_mulai',
		'jam_selesai',

		array(
			'header' => 'Kampus',
			'value' => function($data){
				return !empty($data->kAMPUS) ? $data->kAMPUS->nama_kampus : 'Data kampus kosong';
			}
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
		
		 array(
                'class'=>'CCheckBoxColumn',  //Tambahkan kolom untuk checkbos.
                'selectableRows'=>2,         //MULTIPLE ROWS CAN BE SELECTED.
                'visible' => date('Y-m-d') < $tgl_akhir
                ),
		array(
			'class'=>'CButtonColumn',
			'visible' => date('Y-m-d') < $tgl_akhir
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
</div>

<?php
Yii::app()->clientScript->registerScript('delete','
$("#butt").click(function(){

        var checked=$("#jadwal-grid").yiiGridView("getChecked","jadwal-grid_c15"); 
        var count=checked.length;

        if(count>0 && confirm("Do you want to delete these "+count+" item(s)"))
        {
                $.ajax({
                        data:{checked:checked},
                        url:"'.CHtml::normalizeUrl(array('jadwal/removeSelected')).'",
                        success:function(data){$("#jadwal-grid").yiiGridView("update",{});},              
                });
        }
        });
');
?>
