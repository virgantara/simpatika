<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Kartu'=>array('index'),
	'Bulk',
);

?>

<h1>Cetak Kartu Ujian</h1>


<?php 
 foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div style="color:red">' . $message . "</div>\n";
    }
    

?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'target' => '_blank',
        'class' => 'form-horizontal'
    )
)); 
?>
 <div class="row">
<div class="col-xs-12">
	 <div class="row">
<div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Prodi</label>
        <div class="col-sm-9">
<?php 
$list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'kode_prodi','nama_prodi');
echo CHtml::dropDownList('kode_prodi',isset($_GET['kode_prodi'])?$_GET['kode_prodi']:'',$list,array('id'=>'kode_prodi')); 
?>&nbsp;
</div>
</div>
<div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Kelas</label>
        <div class="col-sm-9">
<?php 
$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus','nama_kampus');
echo CHtml::dropDownList('kode_kampus',isset($_GET['kode_kampus'])?$_GET['kode_kampus']:'',$list,array('id'=>'kode_kampus')); 
?>
</div></div>
<div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Semester</label>
        <div class="col-sm-9">
<?php
$list = array();
for($i=1;$i<=16;$i++){
	$list[$i] = 'Semester '.$i;
}
echo CHtml::dropDownList('semester',isset($_GET['semester'])?$_GET['semester']:'',$list,array('id'=>'semester')); 
?>
</div></div>
<div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Jenis Kartu</label>
        <div class="col-sm-9">

<?php

echo CHtml::dropDownList('jenis',isset($_GET['jenis'])?$_GET['jenis']:'',array('uts'=>'UTS','uas'=>'UAS'),array('id'=>'jenis')); 
?>
</div> 
</div>
<div class="col-sm-offset-3">
<button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Data</button>
</div>
</div> 
</div>
<?php $this->endWidget(); ?>