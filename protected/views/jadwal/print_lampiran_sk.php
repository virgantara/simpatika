<?php 

$sk = Sk::model()->findByAttributes([
  'kode_prodi' => $prodi->kode_prodi,
  'buka' => 1
]);

  



?>

<table style="margin-bottom: 6px;" width="100%">
  <tr>
    <td width="100%" style="text-align: center;" >
      
      <img width="120" src="<?php echo Yii::app()->baseUrl;?>/images/logo_unida.png"/>
    </td>
    
  </tr>
</table>
<br><br>
<table width="100%" style="font-size: 10;font-family: 'Times'">
  <tr>
    <td width="10%">Lampiran:</td>
    <td width="90%"><?=!empty($sk) ? $sk->judul : '';?>
      <br>
      <table width="100%">
      <tr>
        <td width="17%">Nomor</td>
        <td width="3%">:</td>
        <td width="80%"><?=!empty($sk) ? $sk->nomor_sk : '';?></td>
      </tr>
      <tr>
        <td width="17%">Tanggal</td>
        <td width="3%">:</td>
        <td width="80%"><?=!empty($sk) ? $sk->tanggal : '';?></td>
      </tr>
      <tr>
        <td width="17%">Tentang:</td>
        <td width="3%">:</td>
        <td width="80%"><?=!empty($sk) ? $sk->tentang : '';?></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
<br><br>
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
  $total_sks = 0;
  foreach($model as $m)
  {
    $m= (object)$m;


    
    $sks = !empty($list_mk[$m->kode_mk]) ? $list_mk[$m->kode_mk]->sks : 0;
    $total_sks += $sks;

    if($counter==1)
    {
      ?>
        <tr>
     <td width="15%" rowspan="<?=count($model)+1;?>" style="text-align: center;"><?=$m->kode_dosen;?></td>
      <td width="20%" rowspan="<?=count($model)+1;?>" style="text-align: center;"><?=$m->nama_dosen;?></td>
      <td width="35%"  style="text-align: center;"><?=$m->kode_mk.' - '.$m->nama_mk;?></td>
    <td width="8%"  style="text-align: center;"><?=$m->nama_prodi;?></td>
    <td width="7%"  style="text-align: center;"><?=$m->semester;?></td>
    <td width="10%"  style="text-align: center;"><?=!empty($listkelas[$m->kelas]) ? $listkelas[$m->kelas] : $m->kelas;?></td>
    <td width="5%"  style="text-align: center;"><?=$sks;?></td>
     
   </tr>
      <?php     
    }

    else{
  ?>
   <tr>
      <td width="35%"  style="text-align: center;"><?=$m->kode_mk.' - '.$m->nama_mk;?></td>
    <td width="8%"  style="text-align: center;"><?=$m->nama_prodi;?></td>
    <td width="7%"  style="text-align: center;"><?=$m->semester;?></td>
    <td width="10%"  style="text-align: center;"><?=!empty($listkelas[$m->kelas]) ? $listkelas[$m->kelas] : $m->kelas;?></td>
    <td width="5%"  style="text-align: center;"><?=$sks;?></td>
     
   </tr>
   <?php 
 }
   $counter++;
 }
   ?>
   <tr>
    <td style="text-align: right;" colspan="4">Total SKS</td>
    <td width="5%"  style="text-align: center;"><?=$total_sks;?></td>
     
   </tr>
 </tbody>
</table>
<table width="100%" style="font-size: 10;font-family: 'Times';">
  <tr>
    <td width="55%">&nbsp;</td>
    <td width="45%" style="text-align: left">
      
      <p>
      Ditetapkan di Ponorogo,<br>
      Tanggal <?=!empty($sk) ? $sk->tanggal : '';?> <br>
      Dekan Fakultas 

      <?php 
      if(!empty($prodi))
      {
        echo $prodi->kodeFakultas->nama_fakultas;
      }
      ?>
    <br><br><br><br><br><br><br>
      <?php

      if(!empty($prodi))
      {
        echo '<strong>'.$prodi->kodeFakultas->pejabat0->nama_dosen.'</strong>&nbsp;<hr width="150px">';
        echo '&nbsp;'.$prodi->kodeFakultas->pejabat0->niy;
      }
      ?>
        
      </p>
      
    </td>
  </tr>
</table>
