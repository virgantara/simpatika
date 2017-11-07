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
    $list = CHtml::listData(Jadwal::model()->findProdi(), 'kode_prodi','nama_prodi');
    
    echo CHtml::dropDownList($model,'kode_prodi',$list); 
    // echo CHtml::textField('nama_dosen',!empty($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '',array('size'=>20,'maxlength'=>20)); 
    echo CHtml::hiddenField('kode_prodi',$kode_prodi);
    
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


<table style="margin-bottom: 10px">
  <tr>
    
    <td width="40%" style="text-align: left">
<table width="100%" style="margin-left: 5px">
 

  <tr>
    <td width="15%" style="text-align: left"><strong>Nama</strong></td>
    <td width="5%"><strong>:</strong></td>
    <td width="85%" style="text-align: left"><strong><?php echo $dosen->nama_dosen;?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left"><strong>NIY</strong></td>
    <td><strong>:</strong></td>
    <td style="text-align: left"><strong><?php echo $dosen->niy;?></strong></td>
  </tr>
  
</table>
    </td>
   
  </tr>
</table>


<table cellpadding="4" border="1" class="grid">
  
  <thead>
    <tr>
      <th width="8%" rowspan="2" style="text-align: center;"><br><br><strong>HARI</strong></th>
       <th width="91%" colspan="7" style="text-align: center;"><strong>JAM PERKULIAHAN</strong></th>
    </tr>
    <tr>
    <?php 
    $jam = Jam::model()->findAll();
    foreach($jam as $j)
    {
    ?>
      <th width="13%" style="text-align: center"><strong><?php echo $j->prefix.$j->nama_jam;?><br>
        <?php

        echo substr($j->jam_mulai, 0, -3).' - '.substr($j->jam_selesai, 0, -3);
        ?></strong>
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
<td  width="8%" style="text-align: center"><br><br><strong><?php echo strtoupper($h);?></strong></td>
<?php 
foreach($jam as $j)
{
?>
<td width="13%" style="text-align: center;">
<?php 

  $jd = Jadwal::model()->findJadwalDosen($dosen->niy, $h, $j->id_jam);
  // print_r($jd);exit;
  if(!empty($jd))
  {
    echo $jd->nama_mk.'<br>';
    $prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$jd->prodi));

    echo !empty($prodi) ? $prodi->singkatan.'-'.$jd->semester.'<br>' : $jd->nama_prodi.'-'.$jd->semester;
    echo $jd->kAMPUS->nama_kampus.' / '.$jd->SKS.' SKS';
  }
  else{
    echo '<br><br><br><br>';
  }

  // echo !empty($jd->nama_mk) ? $jd->nama_mk : '';
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

<div style="font-size: 9px;text-align: center;">
<br><br><br>
Head Office : Main Campus University of Darussalam Gontor Demangan Siman Ponorogo East Java Indonesia 63471<br>
Phone : (+62352) 483762, Fax : (+62352) 488182, Email : rektorat@unida.gontor.ac.id</div>

<?php
}
?>