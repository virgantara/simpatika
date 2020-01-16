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


	caption.status{
		<?php 
			if($total_bentrok > 5)
			{
				echo 'background: #ec4a4a;';
				echo 'color:white;';
			}

			else if($total_bentrok >= 1 && $total_bentrok < 5)
			{
				echo 'background: #ecbc4a;';
				echo 'color:white;';
			}

			else
			{
				echo 'background: #4aec5d;';
			}
		?>
	}
</style>
<div class="row">
	<div class="col-xs-12">

<?php echo CHtml::link('<i class="glyphicon glyphicon-download"></i> Export ke XLS',array('jadwal/rekapJadwalAllXls'),['class'=>'btn btn-success']); ?>
</div>

	<div class="col-xs-12">

<table class="table table-hovered table-striped">
	 <caption class="status">Ada <?php echo $total_bentrok;?> jadwal bentrok</caption>
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

		// print_r(count($jadwal_prodi));exit;
		foreach($listdosen as $jd)
		{
		  
		  // $jd = (object)$jd;
		  

		  $sks_dosen = 0;
		  $jadwal_perdosen = Jadwal::model()->findRekapJadwalPerDosenAll($jd->nidn);

		  // print_r(count($jadwal_perdosen));

		  if(empty($jadwal_perdosen)) continue;
		
		  foreach($jadwal_perdosen as $m)
		  {	
		  	$m = (object)$m;
		  	 $i++;

		  	$sks_dosen += $m->sks;


		?>
		<tr <?php echo $m->bentrok == 1 ? 'style="background-color:orange"' : '';?>>
		<td width="3%"><?=$i;?></td>
		
		<td width="5%"><?php echo $m->hari;?></td>
		<td><?php echo $m->nama_jam;?></td>
		<td><?php echo substr($m->jam_mulai, 0, -3).'-'.substr($m->jam_selesai, 0, -3);?></td>
		<td><?php echo $m->kode_mk;?></td>
		<td width="15%"><?php echo $m->nama_mk;?></td>
		<td><?php echo $m->kode_dosen;?></td>

		<td width="15%"><?php echo $m->nama_dosen;?></td>

		<td width="5%"><?php echo $m->sks;?></td>
		<td width="5%"><?php echo $m->nama_fakultas;?></td>
		<td width="15%">
			<?php
			 // $prodi = Masterprogramstudi::model()->findByAttributes(array('kode_prodi'=>$m->prodi));
			 echo !empty($listprodi[$m->prodi]) ? $listprodi[$m->prodi]->singkatan : $m->nama_prodi;
			 // echo $m->pRODI->singkatan;
			 ?>
				
			</td>

		<td><?php echo $m->semester;?></td>

		<td><?php echo $m->nama_kampus;?></td>
		<td width="5%"><?php echo $m->nama_kelas;?></td>
		

		</tr>
	<?php 
		}

		$bg_color = '#57d54c';
		$font_color = 'black';
	  	if($sks_dosen >= 20)
	  	{
	  		$bg_color = '#f50c0c';
	  		$font_color = 'white';
	  	} 

	  	else if($sks_dosen <= 15)
	  	{
	  		$bg_color = '#ff8c00';
	  		$font_color = 'white';
	  	}
		?>
		<tr style="background-color: <?=$bg_color;?>;color:<?=$font_color;?>">
		<td width="3%"></td>
		<td></td>
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
		<td></td>
		<!-- <td width="5%"></td> -->


		</tr>
		<?php
		}
	?>
	  </tbody>

	</table>
</div>
</div>