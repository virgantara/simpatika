<?php 
use yii\helpers\ArrayHelper;
$total_abdi = 0;
$total_penunjang = 0;
$total_ajar = 0;
$total_pub = 0;
$total_ajar = 0; 
foreach ($pengajaran as $key => $value) 
{
    $total_ajar += $value->sks_bkd * $value->sks;
}

foreach ($publikasi as $key => $value) 
{
    $total_pub += $value->sks_bkd;
}

foreach ($pengabdian as $key => $value) 
{
    $total_abdi += $value->nilai;
}

foreach ($organisasi as $key => $value) 
{
    $total_penunjang += $value->sks_bkd;
}
foreach ($pengelolaJurnal as $key => $value) 
{
    $total_penunjang += $value->sks_bkd;
}

$total_bkd = $total_ajar+$total_pub+$total_abdi+$total_penunjang;

$persen_a = 0;
$persen_b = 0;
$persen_c = 0;
$persen_d = 0;
$label_a = '';
$label_b = '';
$label_c = '';
$label_d = '';
$bkd_ajar = $bkd_ajar->nilai_minimal > 0 ? $bkd_ajar->nilai_minimal : 1;
$bkd_pub = $bkd_pub->nilai_minimal > 0 ? $bkd_pub->nilai_minimal : 1;
$bkd_abdi = $bkd_abdi->nilai_minimal > 0 ? $bkd_abdi->nilai_minimal : 1;
$bkd_penunjang = $bkd_penunjang->nilai_minimal > 0 ? $bkd_penunjang->nilai_minimal : 1;
$persen_a = round(($total_ajar) / ($bkd_ajar) * 100,2);
$persen_b = round(($total_pub) / ($bkd_pub) * 100,2);
$persen_c = round(($total_abdi) / ($bkd_abdi) * 100,2);
$persen_d = round(($total_penunjang) / ($bkd_penunjang) * 100,2);

$is_cukup_ab = false;
$label_ab = '';
if($total_ajar > $bkd_ajar && $total_pub > $bkd_pub)
{
    $is_cukup_ab = $persen_a + $persen_b >= 100;
}

if($is_cukup_ab){
    $label_ab = '<span > SUDAH mencukupi</span>';
}

else{
    $label_ab = '<span > BELUM mencukupi</span>';
}

$is_cukup_cd = false;
$label_cd = '';
if(!empty($bkd_abdi->nilai_minimal) || !empty($bkd_penunjang->nilai_minimal))
{
    if($total_abdi > $bkd_abdi && $total_penunjang > $bkd_penunjang)
    {
        $is_cukup_cd = $persen_c + $persen_d >= 100;
    }
}

else{
    $is_cukup_cd = true;
}

if($is_cukup_cd){
    $label_cd = '<span > SUDAH mencukupi</span>';
}

else{
    $label_cd = '<span > BELUM mencukupi</span>';
}
?>
<table width="100%">
  <tr>
    
    <td style="text-align: center;">
      <span style="font-size: 1.15em">UNIVERSITAS DARUSSALAM GONTOR</span><br>
      <span style="font-size: 1em">Terakreditasi APT<br>
        Nomor: 1035/SK/BAN-PT/Akred/PT/XII/2020 <br> Kualifikasi BAIK SEKALI</span><br>
      <span style="font-size: 1em">Website: https://unida.gontor.ac.id</span>
 
    </td>
  </tr>
</table>
<br><br>
<table border="0" width="100%" cellpadding="1" cellspacing="0">   
    <tr>
      <th width="30%" ><strong>Nama Dosen</strong></th>
      <th width="70%" >: <?=$user->dataDiri->nama;?></th>
    </tr>
    <tr>
      <th width="30%" ><strong>NIDN/NIY</strong></th>
      <th width="70%" >: <?=$user->dataDiri->NIDN;?> / <?=$user->dataDiri->NIY;?></th>
    </tr>
    <tr>
      <th width="30%" ><strong>Jurusan/Prodi</strong></th>
      <th width="70%" >: <?=$user->prodiUser->nama;?></th>
    </tr>
    <tr>
      <th width="30%" ><strong>Fakutlas</strong></th>
      <th width="70%" >: <?=$user->prodiUser->fakultasProdi->nama;?></th>
    </tr>
    <tr>
      <th width="30%" ><strong>Tahun Laporan</strong></th>
      <th width="70%" >: <?=$bkd_periode->nama_periode;?></th>
    </tr>
    <tr>
      <th width="30%" ><strong>Status</strong></th>
      <th width="70%" >: <?=$user->dataDiri->tugasDosen->nama;?></th>
    </tr>
    <tr>
      <th width="30%" ><strong>Jabfung/Gol</strong></th>
      <th width="70%" >: <?=$user->dataDiri->namaJabfung;?> / <?=$user->dataDiri->namaPangkat;?></th>
    </tr>
</table><br><br>
<table border="1" width="100%" cellpadding="6" cellspacing="0">
    <tr>
      <th style="text-align: center" width="5%">No</th>
      <th style="text-align: center" width="25%">Unsur Utama</th>
      <th style="text-align: center" width="60%">Kegiatan</th>
      <th style="text-align: center" width="10%">Beban Kredit</th>
     
    </tr>
  
     <?php 
    
      $counter = 0;
      $total =0;
      foreach ($results as $key => $value) 
      {
          if(empty($value['items'])) continue;
            
        $subtotal = 0; 
        foreach ($value['items'] as $q => $v) 
        {
          $counter++;

      # code...
          
          $subtotal += $v->sks;
    ?>
    <tr>
        <td style="text-align: center"><?=$counter;?></td>        
        <td style="text-align: center"><?=$value['unsur'];?></td>
        <td><?=$v->deskripsi;?></td>
        <td style="text-align: center"><?=$v->sks;?></td>
      
      </tr>
    <?php 
    }

    $total += $subtotal;
  }
    ?>
    <tr>
        <td colspan="3"  style="text-align: center">Total Kredit</td>
        <td c style="text-align: center"><?=$total;?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Kesimpulan</strong></td>
        <td colspan="2">
            
                Kegiatan Pengajaran dan Penelitian Anda <strong><?=$label_ab;?></strong>
            <br>
                Kegiatan Pengabdian dan Penunjang Anda <strong><?=$label_cd;?></strong>
            
        </td>
    </tr> 
</table>
<br>
        <br>
<table width="100%">
  <tr>
    
    <td style="text-align: center;">
      <span style="font-size: 1.15em">PERNYATAAN DOSEN</span>
     
 
    </td>
  </tr>
</table>
<br><br>
<table border="0" width="100%" cellpadding="1" cellspacing="0">   
    <tr>
      <th style="text-align: justify;">
        Saya dosen yang membuat laporan kinerja ini menyatakan bahwa semua aktivitas dan bukti pendukung aktivitas saya adalah benar dan saya sanggup menerima sanksi apapun apabila pernyataan ini dikemudian hari terbukti tidak benar.
      </th>
    </tr>
    <tr>
      <th  style="text-align: center;">
        <br>
        <br>
        Dosen yang membuat,
        
        <br>
        <br>
        <br>
        <br>
        <?=$user->dataDiri->nama;?><br>
        NIY: <?=$user->NIY;?>
      </th>
    </tr>
    
</table>