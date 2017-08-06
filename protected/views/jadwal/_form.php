<?php
/* @var $this JadwalController */
/* @var $model Jadwal */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kampus'); ?>
		<?php 
		$list = CHtml::listData(Kampus::model()->findAll(), 'nama_kampus', function($dsn) {
		    return ($dsn->nama_kampus);
		});
		echo $form->dropDownList($model,'kampus',$list); 
		// echo $form->textField($model,'kampus',array('size'=>2,'maxlength'=>2)); 
		?>
		<?php echo $form->error($model,'kampus'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'hari'); 
		$list_hari = array(
			'Sabtu'=>'Sabtu',
			'Ahad'=> 'Ahad',
			'Senin'=>'Senin',
			'Selasa'=>'Selasa',
			'Rabu'=> 'Rabu',
			'Kamis'=>'Kamis'
		);
		// CHtml::listData(ClassificationLevels::model()->findAll(), 'id', 'name')
		echo $form->dropDownList($model,'hari',$list_hari); 
		?>
		<?php echo $form->error($model,'hari'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_mulai'); ?>
		<?php echo $form->textField($model,'jam_mulai',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jam_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_selesai'); ?>
		<?php echo $form->textField($model,'jam_selesai',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jam_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_mk'); ?>
		<?php 
		// $listmk = CHtml::listData(Mastermatakuliah::model()->findAll(), 'nama_mata_kuliah', 'nama_mata_kuliah');
		$listmk = CHtml::listData(Mastermatakuliah::model()->findAllByAttributes(array('semester'=>7)), 'nama_mata_kuliah', function($mk) {
		    return ($mk->kode_mata_kuliah . ' - '. $mk->nama_mata_kuliah);
		});
		echo $form->dropDownList($model,'kode_mk',$listmk); 
		?>
		<?php echo $form->error($model,'kode_mk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_dosen'); ?>
		<?php 
		$listdosen = CHtml::listData(Masterdosen::model()->findAll(), 'nama_dosen', function($dsn) {
		    return ($dsn->niy . ' - '. $dsn->nama_dosen);
		});
		echo $form->dropDownList($model,'kode_dosen',$listdosen); 
		// echo $form->textField($model,'kode_dosen',array('size'=>20,'maxlength'=>20)); 
		?>
		<?php echo $form->error($model,'kode_dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php 
		$list = array();
		for($i=1;$i<=8;$i++)
		{
			$list[$i] = $i;
		}
		echo $form->dropDownList($model,'semester',$list); 
		?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas'); ?>
		<?php 
		$list = CHtml::listData(MasterKelas::model()->findAll(), 'nama_kelas', function($dsn) {
		    return ($dsn->nama_kelas);
		});
		echo $form->dropDownList($model,'kelas',$list); 
		?>
		<?php echo $form->error($model,'kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fakultas'); ?>
		<?php 
		$list = CHtml::listData(Masterfakultas::model()->findAll(), 'nama_fakultas', function($dsn) {
		    return ($dsn->nama_fakultas);
		});
		echo $form->dropDownList($model,'fakultas',$list); 
		// echo $form->textField($model,'fakultas',array('size'=>7,'maxlength'=>7)); 
		?>
		<?php echo $form->error($model,'fakultas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prodi'); ?>
		<?php 
		$list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'nama_prodi', function($dsn) {
		    return ($dsn->nama_prodi);
		});
		echo $form->dropDownList($model,'prodi',$list); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		<?php echo $form->error($model,'prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kd_ruangan'); ?>
		<?php echo $form->textField($model,'kd_ruangan',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kd_ruangan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_akademik'); ?>
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(), 'tahun_id', function($dsn) {
		    return ($dsn->tahun_id);
		});
		echo $form->dropDownList($model,'tahun_akademik',$list); 
		// echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); 
		?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kuota_kelas'); ?>
		<?php echo $form->textField($model,'kuota_kelas'); ?>
		<?php echo $form->error($model,'kuota_kelas'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->