<?php 
use yii\helpers\ArrayHelper;

?>
<table width="100%">
  <tr>
    
    <td style="text-align: center;">
      <span style="font-size: 1.15em">LAPORAN KINERJA DOSEN</span><br>
     
 
    </td>
  </tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
<table border="0" width="100%" cellpadding="1" cellspacing="0">   
    <tr>
      <th width="40%" ><strong>Nama Dosen</strong></th>
      <th width="60%" >: <?=$user->dataDiri->nama;?></th>
    </tr>
    <tr>
      <th width="40%" ><strong>NIDN/NIY</strong></th>
      <th width="60%" >: <?=$user->dataDiri->NIDN;?> / <?=$user->dataDiri->NIY;?></th>
    </tr>
    <tr>
      <th width="40%" ><strong>Jurusan/Prodi</strong></th>
      <th width="60%" >: <?=$user->prodiUser->nama;?></th>
    </tr>
    <tr>
      <th width="40%" ><strong>Fakutlas</strong></th>
      <th width="60%" >: <?=$user->prodiUser->fakultasProdi->nama;?></th>
    </tr>
    <tr>
      <th width="40%" ><strong>Tahun Laporan</strong></th>
      <th width="60%" >: <?=$bkd_periode->nama_periode;?></th>
    </tr>
    
</table><br><br>