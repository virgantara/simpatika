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
	table.grid tr td{
		border: 1px solid #999 !important;
	}


	.bentrok { 
	    background-color: orange; 
	}

	.updated{
		background-color: blue;
		color:white;
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
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="row">
		<label>Prodi</label>
		<?php
		$kode_prodi = !empty($_POST['kode_prodi']) ? $_POST['kode_prodi'] : '';
    
    $list = CHtml::listData(Jadwal::model()->findProdi(), 'kode_prodi','nama_prodi');
    
		echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list);
		
		?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Lihat'); ?>

		
		<?php echo !empty($kode_prodi) ? CHtml::link('Export ke XLS',array('site/dataortu','kdprodi'=>$kode_prodi,'xls'=>'y')) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 

if(!empty($kode_prodi))
{
?>
<?php 
	$this->renderPartial('_dataortu_table',[
		'mahasiswas' => $mahasiswas,
		'kdprodi' => $kdprodi,
		'xls' => $xls,
		'mprodi' => $mprodi
	]);
?>
<?php 
}
?>