<?php
/* @var $this JadwalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jadwals',
);

$this->menu=array(
	array('label'=>'Create Jadwal', 'url'=>array('create')),
	array('label'=>'Manage Jadwal', 'url'=>array('admin')),
);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ubah-form',
	'method' => 'GET',
	'action' => Yii::app()->createUrl('jadwal/ubah'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		
		
	)
)); ?>

	<div class="form-group">
		<label for="" class="col-sm-3 control-label no-padding-right">Prodi</label>
		<div class="col-sm-9">
		
		<?php 
		$kode_prodi = !empty($_GET['kode_prodi']) ? $_GET['kode_prodi'] : '';

	$list_prodi = [];
	
	if(Yii::app()->user->checkAccess(array(WebUser::R_SA,WebUser::R_BAAK)))
	{
		$list_prodi = Masterprogramstudi::model()->findAll();	
	}

	else if(Yii::app()->user->checkAccess(array(WebUser::R_PRODI)))
	{
		$prodi = Yii::app()->user->getState('prodi');
		$list_prodi = Masterprogramstudi::model()->findAllByAttributes(['kode_prodi'=>$prodi]);
	}
	
    $list = CHtml::listData($list_prodi, 'kode_prodi','nama_prodi');
    
    echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list); 
		?>
		
		</div>
	</div>

<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
    <?php 
     echo CHtml::tag('button', array(
        'name'=>'cetak',
        'type'=>'submit',
        'class'=>'btn btn-success',
      ), '<i class="glyphicon glyphicon-search"></i> Lihat');

    ?>
        </div>
  

</div><!-- form -->

<?php $this->endWidget(); ?>

<h1>Jadwal Matakuliah Per Semester</h1>
<?php 
foreach($results as $q => $m)
{
?>
<h4 style="text-align: center;">Semester <?=$q;?></h4>
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>No</th>
			<th>Hari</th>
			<th>Jam ke</th>
			<th>Jam Mulai</th>
			<th>Jam Selesai</th>
			<th>Kelas</th>
			<!-- <th>Prodi</th> -->
			<th>Kode MK</th>
			<th>Nama MK jadwal / Nama MK di Kurikulum</th>
			<th>Kode Dosen</th>
			<th>Nama Dosen</th>
			<th>sks</th>
		</thead>
		<tbody>
			<?php 
			foreach ($m as $num => $mk) 
			{
				$matkul = Mastermatakuliah::model()->findByAttributes([
					'kode_mata_kuliah' => $mk->kode_mk,
					'kode_prodi' => $mk->prodi,
					'tahun_akademik' => $ta
				]);

				$label_mk_kurikulum = '';
				
				$mk_kurikulums = Matakuliah::model()->findAllByAttributes([
					'prodi' => $mk->prodi,
					'kode_mk' => $mk->kode_mk
				]);

				if(count($mk_kurikulums) > 0)
				{
					foreach($mk_kurikulums as $mkk)
					{
						$label_mk_kurikulum .= $mkk->nama_mk;
					}
				}

				else
				{
					$label_mk_kurikulum .= 'Oops, MK ini tidak ada di kurikulum';
				}

				
				
				

				// $label_mk = !empty($matkul) ? $matkul->nama_mata_kuliah : '-';
				// $prodi = Masterprogramstudi::model()->findByAttributes(['kode_prodi'=>$mk->prodi]);
			?>
			<tr>
				<td><?=$num+1;?></td>
				<td><?=$mk->hari;?></td>
				<td><?=$mk->jam_ke;?></td>
				<td><?=$mk->jam_mulai;?></td>
				<td><?=$mk->jam_selesai;?></td>
				<td><?=$mk->kAMPUS->nama_kampus;?> - <?=$mk->kELAS->nama_kelas;?></td>

				<td><?=$mk->kode_mk;?></td>
				<td>
					<?php 
					if($mk->nama_mk != $label_mk_kurikulum)
					{
						echo '<div class="alert alert-danger"><strong>MK ini di jadwal berbeda dengan di Matakuliah kurikulum: </strong><br><strong>Jadwal: </strong>'.$mk->nama_mk.' <br><strong>MK Kurikulum: </strong>'.$label_mk_kurikulum.'</div>';
					}

					else
					{
						echo $mk->nama_mk.' <br>'.$label_mk_kurikulum;
					}
					?>
				</td>
				<td><?=$mk->kode_dosen;?></td>
				<td><?=$mk->nama_dosen;?></td>
				<td><?=$mk->SKS;?></td>
			</tr>
			<?php 
			}
			?>
		</tbody>
	</table>
</div>
<?php 
}
?>

