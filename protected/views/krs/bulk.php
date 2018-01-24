<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'KRS'=>array('index'),
	'Bulk',
);

?>

<h1>Cetak Bulk KRS</h1>


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
)); 
?>
 <div class="pull-right">
Angkatan
<?php 
echo CHtml::dropDownList('angkatan',isset($_GET['angkatan'])?$_GET['angkatan']:'',array('372016'=>'TI 4 - 372016','362015'=>'TI 6 - 362015','352014'=>'TI 8 - 362015'),array('id'=>'angkatan')); ?>  
Semester
<?php 
echo CHtml::dropDownList('semester',isset($_GET['semester'])?$_GET['semester']:'',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'),array('id'=>'semester')); ?>  
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