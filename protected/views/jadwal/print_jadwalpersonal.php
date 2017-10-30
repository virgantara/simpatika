<?php 
$list_hari = array(
      'Sabtu'=>'Sabtu',
      'Ahad'=> 'Ahad',
      'Senin'=>'Senin',
      'Selasa'=>'Selasa',
      'Rabu'=> 'Rabu',
      'Kamis'=>'Kamis'
    );
?>
<table style="margin-bottom: 10px">
  <tr>
    <td style="border-right: 3px solid black;;" width="20%" >
      
      <img src="<?php echo Yii::app()->baseUrl;?>/images/logo_unida.png"/>
    </td>
    <td width="40%" style="text-align: left">
<table width="100%" style="margin-left: 5px">
  <tr>
    <td width="100%" colspan="3" style="text-align: left">
<h3>JADWAL PERSONAL DOSEN GASAL<br>UNIVERSITAS DARUSSALAM GONTOR<br>T.A. 1438-1438 H / 2017-2018 M
    </h3>
<br><br><br>
  </td>
    
  </tr>
  <tr>
    <td width="15%" style="text-align: left">Nama</td>
    <td width="5%">:</td>
    <td width="85%" style="text-align: left"><?php echo $dosen->nama_dosen;?></td>
  </tr>
  <tr>
    <td style="text-align: left">NIY</td>
    <td>:</td>
    <td style="text-align: left"><?php echo $dosen->niy;?></td>
  </tr>
  
</table>
    </td>
    <td width="40%" style="font-size:10px; border:1px solid black">
      
      <ul>
        <li><i>Mengabsen secara langsung dan meminta tanda tangan kepada mahasiswa.</i></li>
        <li><i>Tatap muka perkuliahan minimal 14 kali/semester. UTS dan UAS masing-masing 7 kali tatap muka.</i></li>
        <li><i>Jika berhalangan masuk atau ada revisi jadwal, mohon konfirmasi:<br>
         <i>Ka.Bag. Perkuliahan : Samsirin, M.Pd.I. (085233677225)</i><br>
            <i>Kasubbag Jadwal : Islam Daroini, S.Pd.I. (085784321239)</i>
            
        </i></li>
      </ul>
    </td>
  </tr>
</table>
<br><br>
<table cellpadding="4" border="1">
  
  <thead>
    <tr>
      <th width="8%" rowspan="2" style="text-align: center;"><br><br><strong>HARI</strong></th>
       <th width="91%" colspan="7" style="text-align: center;"><strong>JAM PERKULIAHAN</strong></th>
    </tr>
    <tr>
    <?php 
    $jam = Jam::model()->findAll();
    foreach($jam as $j)
    {
    ?>
      <th width="13%" style="text-align: center"><strong><?php echo $j->nama_jam;?><br>
        <?php

        echo substr($j->jam_mulai, 0, -3).' - '.substr($j->jam_selesai, 0, -3);
        ?></strong>
      </th>
      
    
    <?php 
  }
    ?>
    </tr>
 </thead>
  <tbody>
<?php 
  
foreach($list_hari as $q => $h)
{

?>
 <tr>
<td  width="8%" style="text-align: center"><br><br><strong><?php echo strtoupper($h);?></strong></td>
<?php 
foreach($jam as $j)
{
?>
<td width="13%" style="text-align: center;font-size:8px">
<?php 
  $jd = Jadwal::model()->findJadwalDosen($dosen->niy, $h, $j->id_jam);
  // print_r($jd);exit;
  if(!empty($jd))
  {
    echo $jd->nama_mk.'<br>';
    echo $jd->pRODI->singkatan.'-'.$jd->semester.'<br>';
    echo $jd->kAMPUS->nama_kampus.' / '.$jd->SKS.' SKS';
  }
  else{
    echo '<br><br><br><br>';
  }

  // echo !empty($jd->nama_mk) ? $jd->nama_mk : '';
?>
</td>
<?php 
}
?>


</tr>
<?php   
}
?>
</tbody>
</table>