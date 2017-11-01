<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
);

$this->menu=array(
	// array('label'=>'List Jadwal', 'url'=>array('index')),
	// array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>

<style type="text/css">
	table.grid tr td{
		border: 1px solid #999 !important;
	}
</style>
<div class="form">
	<div class="row">
<?php echo CHtml::link('Export ke XLS',array('jadwal/rekapJadwalAllXls')); ?>
</div>
<table border="1" cellpadding="4" style="width: 100%">
<thead>
    <tr>
      <th width="3%">No</th>
      <th width="5%">Hari</th>
      <th>Jam</th>
      <th>Waktu</th>
      <th>Kode Mk</th>
      <th width="15%">Nama Mk</th>
      <th>NIY</th>
      <th width="15%">Nama Dosen</th>
      <th width="5%">SKS</th>
      <th width="5%">Fakultas</th>
      <th width="15%">Prodi</th>
      
      
      <th>Semester</th>
      <th>Kampus</th>
      <th width="5%">Kelas</th>
     
    </tr>
  </thead>
  <tbody>
<?php 

	
	
		$i = 0; 

		
		foreach($jadwal_prodi as $jd)
		{
		  

		  $i++;
		  $sks_dosen = 0;
		  $jadwal_perdosen = Jadwal::model()->findRekapJadwalPerDosenAll($tahun_akademik->tahun_id,$jd->kode_dosen);
		  foreach($jadwal_perdosen as $m)
		  {	
		  	$sks_dosen += $m->SKS;
		?>
		<tr>
		<td width="3%"><?=$i;?></td>
		<td width="5%"><?php echo $m->hari;?></td>
		<td><?php echo $m->jAM->nama_jam;?></td>
		<td><?php echo substr($m->jAM->jam_mulai, 0, -3).'-'.substr($m->jAM->jam_selesai, 0, -3);?></td>
		<td><?php echo $m->kode_mk;?></td>
		<td width="15%"><?php echo $m->nama_mk;?></td>
		<td><?php echo $m->kode_dosen;?></td>

		<td width="15%"><?php echo $m->nama_dosen;?></td>

		<td width="5%"><?php echo $m->SKS;?></td>
		<td width="5%"><?php echo $m->nama_fakultas;?></td>
		<td width="15%">
			<?php
			 $prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$m->prodi));
			 echo !empty($prodi) ? $prodi->singkatan : $m->nama_prodi;
			 // echo $m->pRODI->singkatan;
			 ?>
				
			</td>

		<td><?php echo $m->semester;?></td>

		<td><?php echo $m->kAMPUS->nama_kampus;?></td>
		<td width="5%"><?php echo $m->kELAS->nama_kelas;?></td>


		</tr>
	<?php 
		}

		?>
		<tr>
		<td width="3%"></td>
		<td width="5%"></td>
		<td></td>
		<td></td>
		<td></td>
		<td> </td>
		<td></td>

		<td width="15%" style="text-align: right">Total SKS</td>

		<td width="5%"><?php echo $sks_dosen;?></td>
		<td width="5%"></td>
		<td width="15%"></td>

		<td></td>

		<td></td>
		<td width="5%"></td>


		</tr>
		<?php
	}
	?>
	  </tbody>

	</table>