<?php 
$list_hari = array(
      'Sabtu'=>'Sabtu',
      'Ahad'=> 'Ahad',
      'Senin'=>'Senin',
      'Selasa'=>'Selasa',
      'Rabu'=> 'Rabu',
      'Kamis'=>'Kamis'
    );

$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
    
?>
<table >
  <tr>
    
    <td width="40%" style="text-align: left">
<table width="100%" style="margin-left: 5px">
  <tr>
    <td width="100%" colspan="3" style="text-align: left">
<h3>JADWAL PERSONAL DOSEN<br>UNIVERSITAS DARUSSALAM GONTOR<br>T.A. <?=strtoupper($tahun_akademik->nama_tahun);?>
    </h3>

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
   
  </tr>
</table>

<table cellpadding="3" border="1" width="100%">
  
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
<td width="13%" style="text-align: center;">
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

      $attr = array(
        'kode_mk' => $jd->kode_mk,
        'prodi' => $jd->prodi
      );

      $mk = Matakuliah::model()->findByAttributes($attr);

      $sks = '-';
      $kode_mk = '<span style="color:red">MK '.$jd->kode_mk.' tidak ditemukan di kurikulum</span>';
      $nama_mk = $kode_mk;
      if(!empty($mk))
      {
        $sks = $mk->sks_mk;
        $kode_mk = $mk->kode_mk;
        $nama_mk = $mk->nama_mk;
        // $total_sks += $sks;  
      }

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

      $label0 = $nama_mk.'<br>';
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
      $label1 = $lbl_prodi.'-'.$jd->semester.'<br>';
      $label2 = $jd->nama_kampus.'-'.$jd->nama_kelas.' / '.$sks.' SKS';
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

