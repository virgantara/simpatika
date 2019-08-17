<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Dataortu'=>array('index'),
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
	'action' => $this->createUrl('mastermahasiswa/dataortu'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Kampus</label>
		<div class="col-sm-9">
		<?php 
		$kampus = !empty($_GET['kampus']) ? $_GET['kampus'] : '';
		$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus', 'nama_kampus');
		echo CHtml::dropDownList('kampus',$kampus,$list,array('empty' => '(Pilih Kampus)','class'=>'input')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>		

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Prodi</label>
		<div class="col-sm-9">
		<?php
		$kode_prodi = !empty($_GET['kode_prodi']) ? $_GET['kode_prodi'] : '';
    
    $list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'kode_prodi','nama_prodi');
    
		echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list);
		
		?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Tahun Ajaran Masuk</label>
		<div class="col-sm-9">
		<?php
		$ta_masuk = !empty($_GET['ta_masuk']) ? $_GET['ta_masuk'] : date('Y').'1';
    
  
		echo CHtml::textField('ta_masuk',$ta_masuk);
		
		?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Tgl Masuk</label>
		<div class="col-sm-9">
		<?php
		$tgl_masuk = $_GET['tgl_masuk'] ?: date('Y-m-d');
    	echo CHtml::textField('tgl_masuk', $tgl_masuk);
		?>
		</div>
	</div>
	 <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit">
            <i class="ace-icon glyphicon glyphicon-check bigger-110"></i>
            Lihat
          </button>
          <?php echo !empty($kode_prodi) ? CHtml::link('<i class="glyphicon glyphicon-download"></i> Export ke XLS',array('mastermahasiswa/dataortu','kode_prodi'=>$kode_prodi,'kampus'=>$kampus,'ta_masuk'=>$ta_masuk,'tgl_masuk'=>$tgl_masuk,'xls'=>'y'),['class'=>'btn btn-success']) : ''; ?>
        
        </div>
      </div>

<?php $this->endWidget(); ?>

<?php 

if(!empty($kode_prodi))
{
?>
<?php 
	$this->renderPartial('_dataortu_table',[
		'mahasiswas' => $mahasiswas,
		'kdprodi' => $kdprodi,
		'xls' => $xls,
		'mprodi' => $mprodi,
		'list_agama' => $list_agama,
		'list_pendidikan' => $list_pendidikan,
		'list_pekerjaan'=>$list_pekerjaan,
		'list_penghasilan' => $list_penghasilan,
		'list_keadaan' => $list_keadaan
	]);
?>
<?php 
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tgl_masuk').datepicker({
			showAnim: "fold",
  			dateFormat: "yy-mm-dd",
  			changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
		});
	});
</script>