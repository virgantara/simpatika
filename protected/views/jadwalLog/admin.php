<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
	'Manage',
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
<h1>Manage Catatan</h1>


<script type="text/javascript">
    
	function updateData(){
		 $('#jadwalLog-grid').yiiGridView.update('jadwalLog-grid', {
            url:'?r=jadwalLog/admin&filter='+$('#search').val()+'&size='+$('#size').val()+'&kode_prodi='+$('#kode_prodi').val()   
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
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'jadwalLog-grid',
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
		
		 array(
                'class'=>'CCheckBoxColumn',  //Tambahkan kolom untuk checkbos.
                'selectableRows'=>2,         //MULTIPLE ROWS CAN BE SELECTED.
                ),
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


<?php
Yii::app()->clientScript->registerScript('delete','
$("#butt").click(function(){

        var checked=$("#jadwal-grid").yiiGridView("getChecked","jadwal-grid_c14"); 
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
