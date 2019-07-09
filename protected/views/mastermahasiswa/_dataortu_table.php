

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
$kampus = $_GET['kampus'] ?: '';
$kode_prodi = $_GET['kode_prodi'] ?: '';
$tahun_angkatan = $_GET['tahun_angkatan'] ?: '';
echo CHtml::hiddenField('kampus',$kampus);
echo CHtml::hiddenField('kode_prodi',$kode_prodi);
echo CHtml::hiddenField('tahun_angkatan',$tahun_angkatan);
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
      <th>Data Ortu<br>
      Yg Sudah</th>
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
	<?php 

	if(count($m->ortus) > 1)
	{
		echo '<div class="alert alert-success">';
		foreach($m->ortus as $ortu)
			echo $ortu->hubungan.'<br>';

		echo '</div>';
	}
	else if(count($m->ortus) > 0)
	{
		echo '<div class="alert alert-warning">';
		foreach($m->ortus as $ortu)
			echo $ortu->hubungan;
		echo '</div>';
	}
	else{
		echo '<div class="alert alert-danger">BELUM LENGKAP</div>';
	}
	?>
</td>
<td>
	<a class="btn btn-info btn-xs btn-block" href="<?=Yii::app()->createUrl('mahasiswaOrtu/create',[
	'kode_prodi'=>$kode_prodi,
	'kampus'=>$kampus,
	'tahun_angkatan'=>$tahun_angkatan,
	'nim'=>$m->nim_mhs
	]);?>"><i class="glyphicon glyphicon-plus"></i> Input</a>
	<a class="btn btn-success btn-xs btn-block list-ortu" href="<?=Yii::app()->createUrl('mahasiswaOrtu/admin',['nim'=>$m->nim_mhs]);?>"><i class="glyphicon glyphicon-list"></i>  List</a>
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
function popitup(url,label) {
    var w = screen.width * 0.8;
    var h = 800;
    var left = (screen.width - w) / 2;
    var top = (screen.height - h) / 2;
    
    window.open(url,label,'height='+h+',width='+w+',top='+top+',left='+left);
    
}
	$(document).ready(function(){
		$( ".datepicker" ).datepicker({
			'dateFormat' : 'yy-mm-dd'
		});

		$('.list-ortu').click(function(e){
			e.preventDefault();
			var url = $(this).attr('href');
	        popitup(url,'List Ortu');
		});
	});
</script>
