<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
);

// $this->menu=array(
// 	array('label'=>'List Jadwal', 'url'=>array('index')),
// 	array('label'=>'Manage Jadwal', 'url'=>array('admin')),
// );
?>

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 
<h1>Cetak Lampiran SK Per Dosen</h1>

<script type="text/javascript">
$(document).ready(function(){

	$('#nama_dosen').autocomplete({
      minLength:1,
      select:function(event, ui){
       
        $('#kode_dosen').val(ui.item.id);
        $('#nama_dosen').val(ui.item.value);
                
      },
      
      focus: function (event, ui) {
        $('#kode_dosen').val(ui.item.id);
       $('#nama_dosen').val(ui.item.value);
      },
      source:function(request, response) {
        $.ajax({
                url: "<?php echo Yii::app()->createUrl('Jadwal/GetDosen');?>",
                dataType: "json",
                data: {
                    term: request.term,
                    
                },
                success: function (data) {
                    response(data);
                }
            })
        },
       
  	}); 
});
</script>
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
    <label>Prodi</label>
    <?php
    $kode_prodi = !empty($_POST['kode_prodi']) ? $_POST['kode_prodi'] : '';
    $list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'kode_prodi','nama_prodi');
    
    echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list); 
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
		<?php echo CHtml::submitButton('Download',array('name'=>'cetak')); ?>
		
		<?php 
    // echo !empty($model) ? CHtml::link('Cetak',array('jadwal/cetakPersonal','id'=>$kode_dosen),array('target'=>'_blank')) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
