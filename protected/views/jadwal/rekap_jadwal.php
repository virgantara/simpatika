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


	.bentrok { 
	    background-color: orange; 
	}

	.updated{
		background-color: blue;
		color:white;
	}

</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="row">
		<label>Prodi</label>
		<?php
		$kode_prodi = !empty($_POST['kode_prodi']) ? $_POST['kode_prodi'] : '';
    
    $list = CHtml::listData(Jadwal::model()->findProdi(), 'kode_prodi','nama_prodi');
    
		echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list);
		
		?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Lihat'); ?>

		
		<?php echo !empty($kode_prodi) ? CHtml::link('Export ke XLS',array('jadwal/rekapJadwalXls','id'=>$kode_prodi)) : ''; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 

if(!empty($kode_prodi))
{
?>

<table border="1" cellpadding="4" style="width: 100%">
<?php 

	
// $criteria=new CDbCriteria;
// $criteria->order = 'kode_kampus ASC';

$kampuses = Jadwal::model()->findKampus($kode_prodi);

foreach($kampuses as $kampus)
{	

	foreach($kampus->kelases as $kelas)
	{
		
		$semesters = Jadwal::model()->findSemester($kode_prodi, $kampus->id, $kelas->id);

		foreach($semesters as $key => $semester)
		{
			echo $kelas->id;

			$i = 0; 
		$model = Jadwal::model()->findRekapJadwalPerkelas($kode_prodi, $kampus->id, $kelas->id, $semester);

		if(!empty($model)){
 ?> 
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


		}
		
		foreach($model as $m)
		{

			$m = (object)$m;

			// $d1 = strtotime($m->created);
			// $d2 = strtotime($m->modified);
			// $datetime1 = new DateTime($m->created);
			// $datetime2 = new DateTime($m->modified);
			// $interval = $datetime1->diff($datetime2);
			// $durasi = $interval->format('%d');

			// // print_r($durasi.' '.$m->kode_mk);

			// $updated = '';
			// if($durasi <=7 && $m->created != $m->modified)
				$updated = '';
			if($m->bentrok == 1)
				$updated = 'class="bentrok"';
			
			
			// $mk = Mastermatakuliah::model()->findByAttributes(['tahun_akademik'=>$m->tahun_akademik,'kode_mata_kuliah'=>$m->kode_mk]);
		  $i++;
		?>
		<tr <?php echo $updated;?>>
		<td width="3%"><?=$m->idjadwal;?></td>
		<td width="5%"><?php echo $m->hari;?></td>
		<td><?php echo $m->jam;?></td>
		<td><?php echo substr($m->jam_mulai, 0, -3).'-'.substr($m->jam_selesai, 0, -3);?></td>
		<td><?php echo $m->kode_mk;?></td>
		<td width="15%"><?php echo $m->nama_mk;?></td>
		<td><?php echo $m->kode_dosen;?></td>

		<td width="15%"><?php echo $m->nama_dosen;?></td>

		<td width="5%"><?php echo !empty($list_mk[$m->kode_mk]) ? $list_mk[$m->kode_mk]->sks : 0;?></td>
		<td width="5%"><?php echo $m->nama_fakultas;?></td>
		<td width="15%">
			<?php
			 
			 echo !empty($prodi) ? $prodi->singkatan : $m->nama_prodi;
			 // echo $m->pRODI->singkatan;
			 ?>
				
			</td>

		<td><?php 
		// echo $kode_prodi.' '.$kampus->id.' '.$kelas->id.' '. $semester->semester.'<br>';
		
		echo $semester;?></td>

		<td><?php echo $list_kampus[$m->kampus];?></td>
		<td width="5%"><?php echo !empty($list_kelas[$m->kelas]) ? $list_kelas[$m->kelas] : '';?></td>


		</tr>
	<?php 
			}
		}
	}
}
?>
  </tbody>

</table>
<?php 
}
?>