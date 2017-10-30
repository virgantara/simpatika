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
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="row">
		<label>Nama Dosen</label>
		<?php
		$kode_dosen = !empty($_POST['kode_dosen']) ? $_POST['kode_dosen'] : '';
		
		echo CHtml::textField('nama_dosen',!empty($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '',array('size'=>20,'maxlength'=>20)); 
		echo CHtml::hiddenField('kode_dosen',$kode_dosen);
		
		?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Lihat'); ?>
		
		<?php echo !empty($model) ? CHtml::link('Cetak',array('jadwal/cetakPersonal','id'=>$kode_dosen),array('target'=>'_blank')) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
if(!empty($model))
{

$list_hari = array(
			'Sabtu'=>'Sabtu',
			'Ahad'=> 'Ahad',
			'Senin'=>'Senin',
			'Selasa'=>'Selasa',
			'Rabu'=> 'Rabu',
			'Kamis'=>'Kamis'
		);
?>
<table width="50%" >
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $dosen->nama_dosen;?></td>
	</tr>
	<tr>
		<td>NIY</td>
		<td>:</td>
		<td><?php echo $dosen->niy;?></td>
	</tr>
	
</table>
</div>
<table border="1">
 <thead>
    <tr>
      <th rowspan="2">HARI</th>
      <th colspan="7" style="text-align: center;">JAM PERKULIAHAN</th>
    </tr>
    <tr>
    <?php 
    $jam = Jam::model()->findAll();
    foreach($jam as $j)
    {
    ?>
      <th><?php echo $j->nama_jam;?><br>
      	<?php

      	echo substr($j->jam_mulai, 0, -3).' - '.substr($j->jam_selesai, 0, -3);
      	?>
      </th>
      
    
    <?php 
	}
    ?>
    </tr>
  </thead>
  <tbody>
<?php 
	
foreach($list_hari as $q => $h)
{

?>
 <tr>
<td><strong><?php echo strtoupper($h);?></strong></td>
<?php 
foreach($jam as $j)
{
?>
<td  style="text-align: center">
<?php 
	$jd = Jadwal::model()->findJadwalDosen($dosen->niy, $h, $j->id_jam);
	// print_r($jd);exit;
	if(!empty($jd))
  {
    echo $jd->nama_mk.'<br>';
    echo $jd->pRODI->singkatan.'-'.$jd->semester.'<br>';
    echo $jd->kAMPUS->nama_kampus.' / '.$jd->SKS.' SKS';
  }
?>
</td>
<?php 
}
?>


</tr>
<?php		
}
?>
</tbody>
</table>
<?php 
}
?>