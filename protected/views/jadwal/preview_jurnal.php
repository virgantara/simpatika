<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwal'=>array('index'),
);


?>

<h1>Cetak Jurnal Per Dosen</h1>

<style type="text/css">
	table.grid tr td{
		border: 1px solid #999 !important;
	}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
  'htmlOptions' => array(
    'target' => '_blank'
  )
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

<div class="row">
    <label>Kampus</label>
    <?php
    $kode_kampus = !empty($_POST['kode_kampus']) ? $_POST['kode_kampus'] : '';
    $list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus','nama_kampus');
    
    
    echo CHtml::dropDownList('kode_kampus',$kode_kampus,$list); 
    // echo CHtml::textField('nama_dosen',!empty($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '',array('size'=>20,'maxlength'=>20)); 
    // echo CHtml::hiddenField('kode_p/rodi',$kode_prodi);
    
    ?>

  </div>
  <div class="row">
    <label>Prodi</label>
    <?php
    $kode_prodi = !empty($_POST['kode_prodi']) ? $_POST['kode_prodi'] : '';
    $list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'kode_prodi','nama_prodi');
    
    
    echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list); 
    // echo CHtml::textField('nama_dosen',!empty($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '',array('size'=>20,'maxlength'=>20)); 
    // echo CHtml::hiddenField('kode_p/rodi',$kode_prodi);
    
    ?>

  </div>
  <div class="row">
    <label>Hari</label>
    <?php
    $hari = !empty($_POST['hari']) ? $_POST['hari'] : '';
    $list = array('SABTU'=>'SABTU',
'AHAD'=>'AHAD',
'SENIN'=>'SENIN',
'SELASA'=>'SELASA',
'RABU'=>'RABU',
'KAMIS'=>'KAMIS',
'JUMAT'=>'JUMAT');
    
    
    echo CHtml::dropDownList('hari',$hari,$list); 
    // echo CHtml::textField('nama_dosen',!empty($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '',array('size'=>20,'maxlength'=>20)); 
    // echo CHtml::hiddenField('kode_p/rodi',$kode_prodi);
    
    ?>

  </div>
<!-- 
	<div class="row">
		<label>Nama Dosen</label> -->
		<?php
		// $kode_dosen = !empty($_POST['kode_dosen']) ? $_POST['kode_dosen'] : '';
		
		// echo CHtml::textField('nama_dosen',!empty($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '',array('size'=>20,'maxlength'=>20)); 
		// echo CHtml::hiddenField('kode_dosen',$kode_dosen);
		
		?>
<!-- 
	</div>
 -->
	<div class="row buttons">
		<?php echo CHtml::submitButton('Cetak',array('name'=>'cetak')); ?>
		
		<?php 
    // echo !empty($model) ? CHtml::link('Cetak',array('jadwal/cetakPersonal','id'=>$kode_dosen),array('target'=>'_blank')) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
