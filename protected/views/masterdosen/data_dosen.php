<?php
/* @var $this MasterdosenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pencarian Data Dosen SIMPEG',
);

?>

<h1>Data Dosen SIMPEG</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'method' => 'GET',
	'action' => Yii::app()->createUrl('masterdosen/unduhDataDosen'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal'
	)
)); ?>
<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Nama Dosen</label>
		<div class="col-sm-9">
		<input type="text" name="nama" placeholder="Ketik Nama Dosen">
		</div>
	</div>
	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit">
            <i class="ace-icon fa fa-search bigger-110"></i>
            Cari
          </button>
	  </div>
      </div>
             

<?php $this->endWidget(); ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>No</th>

			<th>Kode Unik</th>
			<th>Nama Dosen</th>
			<th>NIDN</th>
			<th>Email</th>
			<th>Jabfung</th>
			<th>Pangkat/Gol</th>
			<th>Bidang Ilmu</th>
			<th>Expertise</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if(count($results) > 0)
		{
			foreach($results as $q => $m)
			{
			?>
			<tr>
				<td><?=$q+1;?></td>
				<td><?=$m->kode_unik;?></td>
				<td><?=$m->nama;?></td>
				<td><?=$m->NIDN;?></td>
				<td><?=$m->email;?></td>
				<td><?=$m->jabfung;?></td>
				<td><?=$m->pangkat.' / '.$m->golongan;?></td>
				<td><?=$m->bidang_ilmu;?></td>
				<td><?=$m->expertise;?></td>
			</tr>
			<?php 
			}
		}

		else
		{
		?>
		<tr>
			<td colspan="3" class="text-center"><i>Data dosen tidak ditemukan</i></td>
		</tr>
		<?php 
		}
		?>
	</tbody>
</table>