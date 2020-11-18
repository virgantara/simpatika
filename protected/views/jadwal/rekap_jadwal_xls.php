
<?php
header('Content-type: application/excel');
$filename = 'jadwal_prodi.xls';
header('Content-Disposition: attachment; filename='.$filename);

if(!empty($model))
{

?>

<table border="1" cellpadding="4" style="width: 100%;">
  
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
      <th></th>
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
<td><?php echo $m->jam_ke;?></td>
<td><?php echo substr($m->jam_mulai, 0, -3).'-'.substr($m->jam_selesai, 0, -3);?></td>
<td><?php echo $m->kode_mk;?></td>
<td width="15%"><?php echo $m->nama_mk;?></td>
<td><?php echo $m->kode_dosen;?></td>

<td width="15%"><?php echo $m->nama_dosen;?></td>

<td width="5%"><?php echo $m->SKS;?></td>
<td width="5%"><?php echo $m->nama_fakultas;?></td>
<td width="15%"><?php echo $m->pRODI->singkatan;?></td>

<td><?php echo $m->semester;?></td>

<td></td>
<td width="5%"><?php echo $m->kAMPUS->nama_kampus;?> / <?php echo $m->kELAS->nama_kelas;?></td>


</tr>
<?php 
}
?>
  </tbody>

</table>
<?php

}
?>