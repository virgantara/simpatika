<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
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
    
    $list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'kode_prodi','nama_prodi');
    
		echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list);
		
		?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Lihat'); ?>
		
		<?php echo !empty($model) ? CHtml::link('Export ke XLS',array('jadwal/exportRekap','id'=>$kode_prodi)) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php

if(!empty($models))
{

?>

<table border="1" cellpadding="4" style="width: 100%">
<?php 
foreach($models as $model)
{
 ?> 
  <thead>
    <tr>
      <th width="3%">No</th>
      <th width="5%">Hari</th>
      <th>Jam</th>
      <th>Waktu</th>
      <th>Kode Mk</th>
      <th width="15%">Nama Mk</th>
      <th>NIY</th>
      <th width="15%">Nama Dosen</th>
      <th width="5%">SKS</th>
      <th width="5%">Fakultas</th>
      <th width="15%">Prodi</th>
      
      
      <th>Semester</th>
      <th>Kampus</th>
      <th width="5%">Kelas</th>
     
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
	<td width="3%"><?=$i;?></td>
	<td width="5%"><?php echo $m->hari;?></td>
	<td><?php echo $m->jAM->nama_jam;?></td>
	<td><?php echo substr($m->jAM->jam_mulai, 0, -3).'-'.substr($m->jAM->jam_selesai, 0, -3);?></td>
	<td><?php echo $m->kode_mk;?></td>
	<td width="15%"><?php echo $m->nama_mk;?></td>
	<td><?php echo $m->kode_dosen;?></td>

	<td width="15%"><?php echo $m->nama_dosen;?></td>

	<td width="5%"><?php echo $m->SKS;?></td>
	<td width="5%"><?php echo $m->nama_fakultas;?></td>
	<td width="15%"><?php echo $m->pRODI->singkatan;?></td>

	<td><?php echo $m->semester;?></td>

	<td><?php echo $m->kAMPUS->nama_kampus;?></td>
	<td width="5%"><?php echo $m->kELAS->nama_kelas;?></td>


	</tr>
	<?php 
	}
}
?>
  </tbody>

</table>
<?php

}
?>