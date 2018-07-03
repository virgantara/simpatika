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
<?php 
// $i = 0;
$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));

foreach($model as $m)
{

  $m = (object)$m;

  // if($i==1) break;
  // $i++;
?>
<table style="margin-bottom: 6px;font-family: 'Times'">
  <tr>
    <td width="20%" >
      
      <img width="60px" src="<?php echo Yii::app()->baseUrl;?>/images/logo_small.png"/>
    </td>
    <td width="60%" style="text-align: left">
<table width="100%" style="margin-left: 5px;font-family: 'Times'">
  <tr>
    <td width="100%" colspan="3" style="text-align: left">
<h4>JURNAL MATERI KULIAH<br>UNIVERSITAS DARUSSALAM GONTOR<br>SEMESTER 
  <?php 
  // echo substr($tahunaktif->semester, -1) % 2 == 0 ? 'GENAP' : 'GANJIL';
  ?>
   T.A. <?=$tahun_akademik->nama_tahun;?>
    </h4>
  </td>
    
  </tr>
  
</table>
    </td>
    <td width="20%" >
      <table cellpadding="5">
        <tr><td style="border:2px solid black;text-align: center;"><strong><?=$prodi->singkatan.'-'.$m->semester;?></strong></td></tr>
      </table>
      
    </td>
  </tr>
</table>
<table style="margin-left: 5px;font-family: 'Times'">
  <tr>
    <td width="30%" style="text-align: left;font-size:12px">Mata Kuliah</td>
    <td width="3%"><h5>:</h5></td>
    <td width="67%" style="text-align: left;font-size:12px"><h5><?php echo $m->nama_mk;?></h5></td>
  </tr>
  <tr>
    <td style="text-align: left;font-size:12px">Dosen Pengampu</td>
    <td><h5>:</h5></td>
    <td style="text-align: left;font-size:12px"><h5><?php echo ucwords($m->nama_dosen);?></h5></td>
  </tr>
  <tr>
    <td style="text-align: left;font-size:12px">SKS</td>
    <td><h5>:</h5></td>
    <td style="text-align: left;font-size:12px"><h5><?php echo $m->sks;?></h5></td>
  </tr>
  <tr>
    <td style="text-align: left;font-size:12px">Kelas</td>
    <td><h5>:</h5></td>
    <td style="text-align: left;font-size:12px"><h5><?php echo $m->nama_kelas;?></h5></td>
  </tr>
</table>
<table style="margin-left: 5px;font-family: 'Times'" border="1" cellpadding="10">
  <tr>
    <th width="10%" style="text-align: center;font-weight: bold;" >SESI<br>KE-</th>
    <th width="20%" style="text-align: center;font-weight: bold;">TANGGAL</th>
    <th width="55%" style="text-align: center;font-weight: bold;">MATERI KULIAH</th>
    <th width="15%" style="text-align: center;font-weight: bold;">TANDA<br>TANGAN</th>
  </tr>
  <?php 
  
  for($row=0;$row<16;$row++)
  {
  ?>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td  >&nbsp;</td>
  </tr>
  <?php 
  }
  ?>
</table>
<br><br>
<?php 
}
?>