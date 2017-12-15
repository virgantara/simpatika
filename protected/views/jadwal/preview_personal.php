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
<table style="margin-bottom: 6px">
  <tr>
    <td style="border-right: 3px solid black;;" width="20%" >
      
      <img src="<?php echo Yii::app()->baseUrl;?>/images/logo_unida.png"/>
    </td>
    <td width="40%" style="text-align: left">
<table width="100%" style="margin-left: 5px">
  <tr>
    <td width="100%" colspan="3" style="text-align: left">
<h3>JADWAL PERSONAL DOSEN GENAP<br>UNIVERSITAS DARUSSALAM GONTOR<br>T.A. 1438-1438 H / 2017-2018 M
    </h3>
<br><br><br>
  </td>
    
  </tr>
  <tr>
    <td width="15%" style="text-align: left"><strong>Nama</strong></td>
    <td width="5%"><strong>:</strong></td>
    <td width="85%" style="text-align: left"><strong><?php echo $dosen->nama_dosen;?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left"><strong>KD</strong></td>
    <td><strong>:</strong></td>
    <td style="text-align: left"><strong><?php echo $dosen->kode_dosen;?></strong></td>
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
<table cellpadding="3" border="1">
  
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
      <th width="13%" style="text-align: center"><strong><?php echo $j->prefix.$j->nama_jam;?><br>
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
  $jadwaldsn = Jadwal::model()->findJadwalDosen($dosen->kode_dosen, $h, $j->id_jam);

  if(!empty($jadwaldsn))
  {
    $idx = 0;
    $label0 = '';
    $label1 = '';
    $label2 = '';
    $label3 = '';
    $nama_prodi = '';
    foreach($jadwaldsn as $jd)
    {
      $jd = (object)$jd;
      $prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$jd->prodi));

      if(empty($prodi)) continue;
      if($idx == 0)
      {
         $nama_prodi .= $jd->nama_prodi;
      }

      else
      {
        $nama_prodi .= '/'.$jd->nama_prodi;
      }

      $label0 = $jd->nama_mk.'<br>';
      $lbl_prodi = '';
      if($jd->bentrok == 2)
      {
        $jadwal_paralel = Jadwal::model()->findJadwalDosenParalel($jd);
        $index = 0;
        foreach($jadwal_paralel as $jp)
        {
          $jp = (object)$jp;
          if($index != 0)
            $lbl_prodi .= '/'.$jp->nama_prodi;
          else
            $lbl_prodi .= $jp->nama_prodi;

          $index++;
        }
      }

      else
      {
        $lbl_prodi = $prodi->singkatan;
      }
      $label1 = !empty($prodi) ? $lbl_prodi.'-'.$jd->semester.'<br>' : $nama_prodi.'-'.$jd->semester;
      $label2 = $jd->nama_kampus.'-'.$jd->nama_kelas.' / '.$jd->sks.' SKS';
      $label3 = '<br><span style="background-color:yellow">'.substr($jd->jam_mulai, 0, -3).'-'.substr($jd->jam_selesai, 0, -3).'</span>';
      
      $idx++;
    }

    echo $label0;
    echo $label1;
    echo $label2;
    echo $label3;
  }

  else
  {
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

<div style="font-size: 9px;text-align: center;">

Head Office : Main Campus University of Darussalam Gontor Demangan Siman Ponorogo East Java Indonesia 63471<br>
Phone : (+62352) 483762, Fax : (+62352) 488182, Email : rektorat@unida.gontor.ac.id</div>