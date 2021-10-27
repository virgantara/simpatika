<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
);

$this->menu=array(
	array('label'=>'List Jadwal', 'url'=>array('index')),
	array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 
<h1>Cetak Jadwal Per Dosen</h1>

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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="form-group">
		<label class='col-sm-3 control-label no-padding-right'>Nama Dosen</label>
		<div class="col-sm-9">
		<?php

		
		echo CHtml::textField('nama_dosen',!empty($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '',array('size'=>20,'maxlength'=>20)); 
		echo CHtml::hiddenField('kode_dosen',!empty($_POST['kode_dosen']) ? $_POST['kode_dosen'] : '');
		
		?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Lihat'); ?>
		<?php echo !empty($model) ? CHtml::submitButton('Cetak',array('name'=>'cetak')) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php

if(!empty($model))
{

?>


<table class="items">
<caption class=""> </caption><thead>
<tr>
<th>No</th><th>Hari</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Kelas</th><th>Nama Prodi</th><th>Kode Mk</th><th>Nama Mk</th><th>Kode Dosen</th><th>Nama Dosen</th><th>Semester</th><th>Kelas</th><th>SKS</th><th>Kuota</th>
</tr>

</thead>
<tbody>
<?php

$i = 0; 
foreach($model as $m)
{

	$i++;
?>
<tr>
<td><?=$i;?></td>
<td><?php echo $m->hari;?></td>
<td><?php echo $m->jAM->jam_mulai;?></td>
<td><?php echo $m->jAM->jam_selesai;?></td>
<td><?php echo $m->kAMPUS->nama_kampus;?></td>
<td><?php echo $m->nama_prodi;?></td>
<td><?php echo $m->kode_mk;?></td>
<td><?php echo $m->nama_mk;?></td>
<td><?php echo $m->kode_dosen;?></td>
<td><?php echo $m->nama_dosen;?></td>
<td><?php echo $m->semester;?></td>
<td><?php echo $m->kELAS->nama_kelas;?></td>
<td><?php echo $m->SKS;?></td>
<td><?php echo $m->kuota_kelas;?></td>

</tr>
<?php 
}
?>
</tbody>
</table>
<?php 
}
?>