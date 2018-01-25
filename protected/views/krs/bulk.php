<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'KRS'=>array('index'),
	'Bulk',
);

?>

<h1>Cetak Bulk KRS/KHS</h1>


<?php 
 foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div style="color:green">' . $message . "</div>\n";
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
        'target' => '_blank'
    )
)); 
?>
 <div class="pull-right">

<?php 
echo CHtml::dropDownList('krs_khs',isset($_GET['krs_khs'])?$_GET['krs_khs']:'',array('KRS'=>'KRS','KHS'=>'KHS'),array('id'=>'krs_khs')); ?>  
Angkatan
<?php 
echo CHtml::dropDownList('angkatan',isset($_GET['angkatan'])?$_GET['angkatan']:'',array('372016'=>'TI 4 - 372016','362015'=>'TI 6 - 362015','352014'=>'TI 8 - 352014'),array('id'=>'angkatan')); ?>  
Semester
<?php 
echo CHtml::dropDownList('semester',isset($_GET['semester'])?$_GET['semester']:'',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'),array('id'=>'semester')); ?> 
Tahun Akademik
<?php 
echo CHtml::dropDownList('tahun_akademik',isset($_GET['tahun_akademik'])?$_GET['tahun_akademik']:'',array('20141'=>'20141','20142'=>'20142','20151'=>'20151','20152'=>'20152','20161'=>'20161','20162'=>'20162'),array('id'=>'tahun_akademik')); ?>  
Tanggal Cetak
<?php 
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'tanggal',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
        'changeMonth' => true,
        'changeYear' => true,
        'dateFormat' => 'dd-mm-yy'
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
 echo CHtml::submitButton('Cetak'); ?>
</div> 

<?php $this->endWidget(); ?>