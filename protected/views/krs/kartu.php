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
        'target' => '_blank'
    )
)); 
?>
 <div class="pull-right">

Prodi
<?php 
$list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'kode_prodi','nama_prodi');
echo CHtml::dropDownList('kode_prodi',isset($_GET['kode_prodi'])?$_GET['kode_prodi']:'',$list,array('id'=>'kode_prodi')); 
?>&nbsp;
Kampus
<?php 
$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus','nama_kampus');
echo CHtml::dropDownList('kode_kampus',isset($_GET['kode_kampus'])?$_GET['kode_kampus']:'',$list,array('id'=>'kode_kampus')); 

echo ' Semester '; 
$list = array(
	'1'=>'Semester 1',
	'2'=>'Semester 2',
	'3'=>'Semester 3',
	'4'=>'Semester 4',
	'5'=>'Semester 5',
	'6'=>'Semester 6',
	'7'=>'Semester 7',
	'8'=>'Semester 8',
);
echo CHtml::dropDownList('semester',isset($_GET['semester'])?$_GET['semester']:'',$list,array('id'=>'semester')); 

 echo CHtml::submitButton('Cetak'); ?>
</div> 

<?php $this->endWidget(); ?>