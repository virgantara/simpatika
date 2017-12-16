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
    <td width="90%"><?=$setting_sk->bunyi_lampiran;?>
      <br>
      <table width="100%">
      <tr>
        <td width="17%">Nomor</td>
        <td width="3%">:</td>
        <td width="80%"><?=$setting_sk->nomor_sk;?></td>
      </tr>
      <tr>
        <td width="17%">Tanggal</td>
        <td width="3%">:</td>
        <td width="80%"><?=$setting_sk->tanggal_sk;?></td>
      </tr>
      <tr>
        <td width="17%">Tentang:</td>
        <td width="3%">:</td>
        <td width="80%"><?=$setting_sk->tentang;?></td>
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
<table width="100%" style="font-size: 10;font-family: 'Times';">
  <tr>
    <td width="45%">&nbsp;</td>
    <td width="55%" style="text-align: left">
      
      <p>Ditetapkan di Ponorogo,</p>
      <p>Pada Tanggal <?=$setting_sk->tanggal_sk;?><br>Rektor UNIDA Gontor.</p>
      <img width="210px" src="<?php echo Yii::app()->baseUrl;?>/images/ttd.jpg"/>
      <!-- <u><strong><p>Prof. Dr. Amal Fathullah Zarkasyi, M.A.</p></strong></u> -->
    </td>
  </tr>
</table>
