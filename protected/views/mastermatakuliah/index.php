<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Mata Kuliah'=>array('index'),
);

$this->menu=array(
	// array('label'=>'List Jadwal', 'url'=>array('index')),
	// array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>

<style type="text/css">


	.bentrok { 
	    background-color: orange; 
	}

	.updated{
		background-color: blue;
		color:white;
	}

	
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'method' => 'get',
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
	'action' => $this->createUrl('mastermatakuliah/index'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Prodi</label>
		<div class="col-sm-9">
		<?php
		$kode_prodi = !empty($_GET['kode_prodi']) ? $_GET['kode_prodi'] : '';
    	
    	$results = null;
    	if(Yii::app()->user->checkAccess([WebUser::R_SA])){
    		$results = Masterprogramstudi::model()->findAll();
    	}

    	else if(!Yii::app()->user->isGuest){
    		$results = Masterprogramstudi::model()->findAllByAttributes(['kode_prodi'=>Yii::app()->user->getState('prodi')]);

    	}
    	$list = CHtml::listData($results, 'kode_prodi','nama_prodi');
    
		echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list);
		
		?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Tahun Akademik</label>
		<div class="col-sm-9">
		<?php
		$tahun_akademik = !empty($_GET['tahun_akademik']) ? $_GET['tahun_akademik'] : date('Y').'1';
    
  
		echo CHtml::textField('tahun_akademik',$tahun_akademik);
		
		?>
		</div>
	</div>

	 <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit">
            <i class="ace-icon glyphicon glyphicon-check bigger-110"></i>
            Lihat
          </button>
        
        
        </div>
      </div>

<?php $this->endWidget(); ?>

<?php 

if(!empty($kode_prodi))
{
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,	
	'action' => $this->createUrl('mastermahasiswa/updatebio'),
)); ?>
<?php 
foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-success">' . $message . "</div>\n";
}
    ?>
<table class="table table-striped table-bordered">
<?php 

$kode_prodi = $_GET['kode_prodi'] ?: '';
echo CHtml::hiddenField('kode_prodi',$kode_prodi);

$tahun_akademik = $_GET['tahun_akademik'] ?: '';
echo CHtml::hiddenField('tahun_akademik',$tahun_akademik);

 ?> 
  <thead>
    <tr>
      <th width="3%">No</th>
      <th width="25%">Kode Feeder</th>
      <th width="10%">Kode MK</th>
      <th width="20%">Nama MK</th>
      <th width="10%">Tahun Akademik</th>
      <th width="10%">Semester</th>
      <th width="3%">SKS</th>
      
    </tr>
  </thead>
  <tbody>
 <?php

$i = 0;
foreach($list_matkul as $m)
{

?>
<tr>
<td><?=($i+1);?></td>
<td><input type="text" class="input kode_feeder" size="40" value="<?=$m->kode_feeder;?>"/>

<a class="btn btn-success btn-sm sync" data-item="<?=$m->kode_mata_kuliah;?>" href="javascript:void(0)"><i class="glyphicon glyphicon-refresh"></i>  Get ID from Feeder</a>
	<span class="loading" style="display: none">Syncing...</span>
</td>
<td><?php echo $m->kode_mata_kuliah;?>
	
</td>
<td><?= $m->nama_mata_kuliah;?><br>
	<input data-item="<?=$m->kode_mata_kuliah;?>" placeholder="Nama MK Bahasa Inggris" type="text" class="nama_mk_en" size="40" value="<?= $m->nama_mata_kuliah_en;?>" />
	<span class="loading" style="display: none">Saving...</span>
	<span class="msg" style="display: none"></span>
</td>

<td><?=$m->tahun_akademik;?></td>
<td><?=$m->semester;?></td>
<td><?=$m->sks;?></td>
</tr>
		
	<?php
	$i++;
}			
?>

  </tbody>

</table>
<?php $this->endWidget(); ?>
<?php 
}
?>

<script type="text/javascript">

	$(document).ready(function(){
		$( ".datepicker" ).datepicker({
			'dateFormat' : 'yy-mm-dd'
		});

		$('.nama_mk_en').keydown(function(e){
			if(e.which == 13){
				var kode_mk = $(this).attr('data-item');
				var stat = $(this).next();
				var msg = $(this).next().next();
				var namaEn = $(this);
				$.ajax({
					type : 'POST',
	                url: "<?php echo Yii::app()->createUrl('mastermatakuliah/ajaxSave');?>",
	                // dataType: "json",
	                data: 'kode_mk='+kode_mk+'&prodi='+$('#kode_prodi').val()+'&tahun='+$('#tahun_akademik').val()+'&nama_en='+namaEn.val(),
	                beforeSend: function(){
	                	stat.show();
	                },
	                error : function(e){
	                	stat.hide();
	                },
	                success: function (data) {
	                    stat.hide();
	                    var hsl = $.parseJSON(data);
	                    msg.show();
	                    msg.html(hsl.msg);
	                }
		        });
			}
			
		});

		$('.sync').click(function(){
			var kode_mk = $(this).attr('data-item');
			var stat = $(this).next();
			var syncBtn = $(this);
			$.ajax({
				type : 'POST',
                url: "<?php echo Yii::app()->createUrl('mastermatakuliah/ajaxSync');?>",
                // dataType: "json",
                data: 'kode_mk='+kode_mk,
                beforeSend: function(){
                	stat.show();
                },
                error : function(e){
                	stat.hide();
                },
                success: function (data) {
                    stat.hide();
                    var hsl = $.parseJSON(data);

                    if(hsl.hasil.status == 200){
                    	if(hsl.value){
                    		syncBtn.prev().val(hsl.value);
                    	}
                    	else
                    		console.log(JSON.stringify(hsl));
                    }
                    else{
                    	console.log(JSON.stringif(hsl));
                    }
                }
	        });
		});

	});
</script>
