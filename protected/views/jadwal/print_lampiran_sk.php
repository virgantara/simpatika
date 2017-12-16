
<table cellpadding="2" border="1" width="100%" style="font-size: 10;font-family: 'Times'">
  
  <thead>
    <tr>
      <th width="15%"  style="text-align: center;"><strong>KD</strong></th>
      <th width="20%"  style="text-align: center;"><strong>NAMA<br>DOSEN</strong></th>
      <th width="35%"  style="text-align: center;"><strong>MATA KULIAH</strong></th>
    <th width="8%"  style="text-align: center;"><strong>PRODI</strong></th>
    <th width="7%"  style="text-align: center;"><strong>SMTR</strong></th>
    <th width="10%"  style="text-align: center;"><strong>KELAS</strong></th>
    <th width="5%"  style="text-align: center;"><strong>SKS</strong></th>
    
    </tr>
 </thead>
 <tbody>
  <?php 
  $counter = 1;
  foreach($model as $m)
  {

    $kelas = Masterkelas::model()->findByPk($m->kelas);
    if($counter==1)
    {
      ?>
        <tr>
     <td width="15%" rowspan="<?=count($model)+1;?>" style="text-align: center;"><?=$m->kode_dosen;?></td>
      <td width="20%" rowspan="<?=count($model)+1;?>" style="text-align: center;"><?=$m->nama_dosen;?></td>
      <td width="35%"  style="text-align: center;"><?=$m->nama_mk;?></td>
    <td width="8%"  style="text-align: center;"><?=$m->nama_prodi;?></td>
    <td width="7%"  style="text-align: center;"><?=$m->semester;?></td>
    <td width="10%"  style="text-align: center;"><?=$kelas->nama_kelas;?></td>
    <td width="5%"  style="text-align: center;"><?=$m->SKS;?></td>
     
   </tr>
      <?php     
    }

    else{
  ?>
   <tr>
      <td width="35%"  style="text-align: center;"><?=$m->nama_mk;?></td>
    <td width="8%"  style="text-align: center;"><?=$m->nama_prodi;?></td>
    <td width="7%"  style="text-align: center;"><?=$m->semester;?></td>
    <td width="10%"  style="text-align: center;"><?=$kelas->nama_kelas;?></td>
    <td width="5%"  style="text-align: center;"><?=$m->SKS;?></td>
     
   </tr>
   <?php 
 }
   $counter++;
 }
   ?>
 </tbody>
</table>
