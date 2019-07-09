

<?php 
	if($xls == 'y'){
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename='.$filename);
header("Content-Transfer-Encoding: BINARY");
	}
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,	
	'action' => $this->createUrl('mastermahasiswa/updatebio'),
)); ?>
<?php 
foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div style="color:white;width:100%;background-color:green;padding:10px">' . $message . "</div>\n";
}
    ?>
<table class="table table-striped table-bordered">
<?php 

echo CHtml::hiddenField('kampus',$_GET['kampus'] ?: '');
echo CHtml::hiddenField('kode_prodi',$_GET['kode_prodi'] ?: '');
echo CHtml::hiddenField('tahun_angkatan',$_GET['tahun_angkatan'] ?: '');
 ?> 
  <thead>
    <tr>
      <th width="3%">No</th>
       <th width="5%">NIM</th>
      
     
      <th width="30%">Nama</th>
      <th>Tmpt Lhr</th>
      <th>Tgl Lhr</th>
      <th>JK</th>
      <th width="15%">ALAMAT</th>
      <th width="5%">KTP</th>
      <th width="5%">Prodi</th>
      <th width="15%">Fakultas</th>
      
      <th>Tahun Masuk</th>	
      <th>Agama</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
 <?php

$i = 0;
foreach($mahasiswas as $m)
{

	$q = $m->agama ?: 'I';
	$agama = $list_agama[$q];

	$jml_ortu = count($m->ortus);
	$bg = '';

	switch ($jml_ortu) {
		case 1:
			$bg = 'background-color: orange;color:white';
			break;
		case 2:
			$bg = 'background-color: green;color:white';
			break;
		default:
			$bg = 'background-color: red;color:white';
			break;
	}
?>
<tr>
<td width="3%"><?=($i+1);?></td>

<td width="5%"><?php echo $m->nim_mhs;?></td>
<td><?php echo $m->nama_mahasiswa;?></td>
<td>
<input type="text" size="10" name="tempat_lahir_<?=$m->nim_mhs;?>" value="<?=$m->tempat_lahir ?: '';?>" />
</td>
<td>
<input type="text" size="10"  class="datepicker" name="tgl_lahir_<?=$m->nim_mhs;?>" value="<?=$m->tgl_lahir ?: '';?>" />
</td>
<td><?php echo $m->jenis_kelamin;?></td>

<td width="15%"><?= $m->alamat.' '.$m->rt.' '.$m->rw.' '.$m->dusun.' '.$m->desa.' '.$m->kecamatan.' '.$m->kabupaten.' '.$m->provinsi;?></td>

<td width="5%">
<input type="text" size="10" name="ktp_<?=$m->nim_mhs;?>" value="<?=$m->ktp ?: '';?>" />
</td>
<td><?=$m->prodi->nama_prodi;?></td>
<td><?=$m->prodi->fakultas->nama_fakultas;?></td>

<td><?=substr($m->nim_mhs, 2,4)?></td>
<td width="15%"><?=$agama;?></td>

<td>
	<a href="<?=Yii::app()->createUrl('mahasiswaOrtu/create',['nim'=>$m->nim_mhs]);?>">Input</a>
	<a href="<?=Yii::app()->createUrl('mahasiswaOrtu/admin',['nim'=>$m->nim_mhs]);?>">List</a>
</td>
</tr>
		
	<?php
	$i++;
}			
?>

  </tbody>

</table>
<?php echo CHtml::submitButton('Update'); ?>
<?php $this->endWidget(); ?>


<script type="text/javascript">
	$(document).ready(function(){
		$( ".datepicker" ).datepicker({
			'dateFormat' : 'yy-mm-dd'
		});
	});
</script>