

<?php 
	if($xls == 'y'){
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename='.$filename);
header("Content-Transfer-Encoding: BINARY");
	}
?>

<table border="1" cellpadding="4" style="width: 100%">
<?php 


 ?> 
  <thead>
    <tr>
      <th width="3%">No</th>
       <th width="5%">NIM</th>
      
     
      <th>Nama</th>
      <th>TTL</th>
      <th>JK</th>
      <th width="15%">ALAMAT</th>
      <th width="5%">KTP</th>
      <th width="5%">Prodi</th>
     	<th width="15%">Fakultas</th>
      
      <th>Tahun Masuk</th>	
      <th>Agama</th>

     
    </tr>
  </thead>
  <tbody>
 <?php

$i = 0;
foreach($mahasiswas as $m)
{
	$q = $m->agama ?: 'I';
	$agama = $list_agama[$q];
?>
<tr>
<td width="3%"><?=($i+1);?></td>

<td width="5%"><?php echo $m->nim_mhs;?></td>
<td><?php echo $m->nama_mahasiswa;?></td>
<td><?php echo $m->tempat_lahir.', '.$m->tgl_lahir;?></td>
<td><?php echo $m->jenis_kelamin;?></td>

<td width="15%"><?php echo $m->alamat.' '.$m->rt.' '.$m->rw.' '.$m->dusun.' '.$m->desa.' '.$m->kecamatan.' '.$m->kabupaten.' '.$m->provinsi;?></td>

<td width="5%"><?php echo $m->ktp;?></td>
<td><?=$m->prodi->nama_prodi;?></td>
<td><?=$m->prodi->fakultas->nama_fakultas;?></td>

<td><?=substr($m->nim_mhs, 2,4)?></td>
<td width="15%"><?$agama ?: 'ISLAM';?></td>



</tr>

		
	
	<?php 
	$i++;

	if(!empty($m->ortus) )
	{
?>
<tr>
	<td colspan="11">
	<table >
	<tr>
		<th></th>
      <th width="5%">Data Ortu</th>

      <th width="15%">Nama</th>
      <th width="30%">Alamat</th>
      <th>Agama</th>
      <th>Pendidikan</th>
      <th width="15%">Pekerjaan</th>
      <th width="15%">Penghasilan</th>
      <th>Status</th>
     
     
    </tr>
<?php
	foreach($m->ortus as $ortu)
	{
		$agama = $list_agama[$ortu->agama];
		// $agama = Pilihan::model()->findByAttributes([
		// 	'kode' => 51,
		// 	'value' => $ortu->agama
		// ]);

		$pendidikan = Pilihan::model()->findByAttributes([
			'kode' => '01',
			'value' => $ortu->pendidikan
		]);

		$pekerjaan = Pilihan::model()->findByAttributes([
			'kode' => 55,
			'value' => $ortu->pekerjaan
		]);

		$penghasilan = Pilihan::model()->findByAttributes([
			'kode' => 69,
			'value' => $ortu->penghasilan
		]);

		$keadaan = Pilihan::model()->findByAttributes([
			'kode' => 53,
			'value' => $ortu->hidup
		]);
	?>
	<tr>
		<td></td>
      <td><?=$ortu->hubungan;?></td>

      <td><?=ucwords($ortu->nama);?></td>
      <td ><?=$ortu->fullalamat;?></td>
      
      <td><?=!empty($agama) ? $agama : '-';?></td>
      <td><?=!empty($pendidikan) ? $pendidikan->label : '-';?></td>
      <td><?=!empty($pekerjaan) ? $pekerjaan->label : '-';?></td>
      <td ><?=!empty($penghasilan) ? $penghasilan->label : '-';?></td>
      <td><?=!empty($keadaan) ? $keadaan->label : '-';?></td>
      
     
    </tr>
	<?php 
}
	?>
</table>

</td>	
</tr>
	<?php
	}

?>
<?php
}			
?>
  </tbody>

</table>