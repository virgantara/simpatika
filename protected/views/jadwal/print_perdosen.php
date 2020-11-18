<table cellpadding="4" style="font-size: 8px">
  
  <thead>
    <tr>
      <th>
      LAPORAN PER DOSEN 
      </th>
      
      
    </tr>
  </thead>
  </table>
<table border="1" cellpadding="4" style="font-size: 8px">
  
  <thead>
    <tr>
      <th width="3%">No</th>
      <th width="5%">Hari</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Kelas</th>
      <th width="15%">Nama Prodi</th><th>Kode Mk</th>
      <th width="15%">Nama Mk</th>
      <th >Kode Dosen</th>
      <th width="15%">Nama Dosen</th><th>Semester</th>
      <th width="5%">Kelas</th>
      <th width="5%">SKS</th>
      <th width="5%">Kuota</th>
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
<td><?php echo $m->jAM->jam_mulai;?></td>
<td><?php echo $m->jAM->jam_selesai;?></td>
<td><?php echo $m->kAMPUS->nama_kampus;?></td>
<td width="15%"><?php echo $m->nama_prodi;?></td>
<td><?php echo $m->kode_mk;?></td>
<td width="15%"><?php echo $m->nama_mk;?></td>
<td><?php echo $m->kode_dosen;?></td>
<td width="15%"><?php echo $m->nama_dosen;?></td>
<td><?php echo $m->semester;?></td>
<td width="5%"><?php echo $m->kELAS->nama_kelas;?></td>
<td width="5%"><?php echo $m->SKS;?></td>
<td width="5%"><?php echo $m->kuota_kelas;?></td>

</tr>
<?php 
}
?>
  </tbody>

</table>