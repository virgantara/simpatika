<?php
/* @var $this JadwalController */
/* @var $model Jadwal */
/* @var $form CActiveForm */
// $tahunaktif = '20172';//Yii::app()->request->cookies['tahunaktif']->value'';




?>


<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui-timepicker-addon.min.css"> 




<div id="info" style="display:none;background-color: #FE9A2E;color:black;padding:5px 8px">
	
</div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
)); 
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'kampus',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
			<?php 
			$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus','nama_kampus');
			
			echo $form->dropDownList($model,'kampus',$list,['class'=>'form-control']); 
			// echo $form->textField($model,'kampus',array('size'=>2,'maxlength'=>2)); 
			?>
			<?php echo $form->error($model,'kampus'); ?>
		</div>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'hari',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		
		<div class="col-sm-9">
		<?php
		$list_hari = array(
			'SABTU'=>'SABTU',
			'AHAD'=> 'AHAD',
			'SENIN'=>'SENIN',
			'SELASA'=>'SELASA',
			'RABU'=> 'RABU',
			'KAMIS'=>'KAMIS'
		);

		

		// print_r($model->hari);
		// CHtml::listData(ClassificationLevels::model()->findAll(), 'id', 'name')
		echo $form->dropDownList($model,'hari',$list_hari,['class'=>'form-control']); 
		?>
		<?php echo $form->error($model,'hari'); ?>
	</div>
	</div>
<div class="form-group">
		<?php echo $form->labelEx($model,'jam_ke',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php 
		$list = CHtml::listData(Jam::model()->findAll(), 'id_jam','nama_jam');
		// $list[] = array('Lainnya');
		
		echo $form->dropDownList($model,'jam_ke',$list,['class'=>'form-control']); 

		?>
		<?php echo $form->error($model,'jam_ke'); ?>
	</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'jam_mulai',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php

		
		echo $form->textField($model,'jam_mulai',['class'=>'form-control']);
		?>
		<?php echo $form->error($model,'jam_mulai'); ?>
	</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'jam_selesai',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php

		
		echo $form->textField($model,'jam_selesai',['class'=>'form-control']);
		?>
		<?php echo $form->error($model,'jam_selesai'); ?>
	</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'fakultas',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php 
		$list = CHtml::listData(Masterfakultas::model()->findAll(), 'kode_fakultas', function($dsn) {
		    return ($dsn->nama_fakultas);
		});
		echo $form->dropDownList($model,'fakultas',$list,['class'=>'form-control']);
		// echo $form->textField($model,'fakultas',array('size'=>7,'maxlength'=>7)); 
		?>
		<?php echo $form->error($model,'fakultas'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'prodi',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php 
		$prodis = array();

		echo $form->dropDownList($model,'prodi',$prodis,['class'=>'form-control','empty' => '(Select a prodi)']); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		<?php echo $form->error($model,'prodi'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode_mk',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		
		<div class="col-sm-9">
		<?php 

		

		// $listmk = CHtml::listData(Mastermatakuliah::model()->findAllByAttributes(array('tahun_akademik'=>$tahunaktif)), 'nama_mata_kuliah', function($mk) {
		//     return ($mk->kode_mata_kuliah . ' - '. $mk->nama_mata_kuliah);
		// });

		$listmk = array();

		echo $form->dropDownList($model,'kode_mk',$listmk,['class'=>'form-control','empty' => '(Select a mk)']); 
		// echo $form->dropDownList($model,'kode_mk',$listmk); 
		?>
		<?php echo $form->error($model,'kode_mk'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_dosen',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php

		$nama_dosen = '';
		if(!$model->isNewRecord)
		{
			$dosen = Masterdosen::model()->findByAttributes(array('nidn'=>$model->kode_dosen));
			// echo $model->kode_dosen;
			if(!empty($dosen))
				$nama_dosen = $dosen->nama_dosen;
		}
		echo $form->hiddenField($model,'kode_dosen',array('size'=>20,'maxlength'=>20));
		echo CHtml::textField('nama_dosen',$nama_dosen,['class'=>'form-control','size'=>20,'maxlength'=>20,'id'=>'nama_dosen']); 
		?>
		<?php echo $form->error($model,'kode_dosen'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'semester',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php 
		$list = array();
		for($i=1;$i<=8;$i++)
		{
			$list[$i] = $i;
		}
		echo $form->dropDownList($model,'semester',$list,['class'=>'form-control']); 
		?>
		<?php echo $form->error($model,'semester'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kelas',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php 
		// $list = CHtml::listData(MasterKelas::model()->findAll(), 'nama_kelas', function($dsn) {
		//     return ($dsn->nama_kelas);
		// });
		$list = CHtml::listData(Masterkelas::model()->findAll(), 'id','nama_kelas');
		echo $form->dropDownList($model,'kelas',$list,['class'=>'form-control']); 
		?>
		<?php echo $form->error($model,'kelas'); ?>
	</div>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'kd_ruangan',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kd_ruangan',['class'=>'form-control']);?>
		<?php echo $form->error($model,'kd_ruangan'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahun_akademik',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(array('order'=>'tahun_id DESC')), 'tahun_id', function($dsn) {
		    return ($dsn->tahun_id);
		})
		;

		echo $form->dropDownList($model,'tahun_akademik',$list,['class'=>'form-control']); 
		// echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); 
		?>
		<?php echo $form->error($model,'tahun_akademik'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo CHtml::label('SKS','',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo CHtml::textField('sks',$model->SKS,['class'=>'form-control']); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kuota_kelas',['class'=>'col-sm-3 control-label no-padding-right']); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'kuota_kelas',['class'=>'form-control']); ?>
		<?php echo $form->error($model,'kuota_kelas'); ?>
		</div>
	</div>

	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit">
            <i class="ace-icon glyphicon glyphicon-check bigger-110"></i>
            Save
          </button>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui-timepicker-addon.min.js"></script>

<script type="text/javascript">

function cekKonflik(){

	var k = $('#Jadwal_kampus').val();
	var h = $('#Jadwal_hari').val();
	var ja = $('#Jadwal_jam_mulai').val();
	var js = $('#Jadwal_jam_selesai').val();

	$.ajax({
		type : 'POST',
		data : 'k='+k+'&h='+h+'&ja='+ja+'&js='+js,
		url : '<?php echo Yii::app()->createUrl('jadwal/cekKonflik');?>',
		success : function(data){

			$('#info').hide();

			var data = JSON.parse(data);

			if(data.code != 1){
				$('#info').show();
				$('#info').html(data.msg);	
			}
						
		}

	});
}

function findProdi(fak){
	$.ajax({
		type : 'POST',
		data : 'q='+fak,
		url : '<?php echo Yii::app()->createUrl('jadwal/getProdi');?>',
		success : function(data){
			$('#Jadwal_prodi').empty();

			var jsondata = JSON.parse(data);


			var row = '';
			$.each(jsondata,function(i,item){
				row += '<option value="'+i+'">'+item+'</option>';
			});

			$('#Jadwal_prodi').append(row);

			var prodi = $('#Jadwal_prodi').val();

			<?php 
				if(!$model->isNewRecord)
				{
			?>

				prodi = <?php echo $model->prodi;?>;
				$('#Jadwal_prodi').val(prodi);

			<?php
				}
			?>

			// alert(prodi);
			findMk(prodi);
		}

	});
}

function findMk(prodi){


	$.ajax({
		type : 'POST',
		data : 'q='+prodi,
		url : '<?php echo Yii::app()->createUrl('jadwal/getProdiJadwal');?>',
		success : function(data){
			$('#Jadwal_kode_mk').empty();

			var jsondata = JSON.parse(data);

			var row = '';
			$.each(jsondata,function(i,item){
				row += '<option value="'+i+'">'+i+' - '+item+'</option>';
			});

			$('#Jadwal_kode_mk').append(row);


			<?php 
				if(!$model->isNewRecord)
				{
			?>

				var kode_mk = '<?php echo $model->kode_mk;?>';
				$('#Jadwal_kode_mk').val(kode_mk);
			<?php
				}
			?>
		}

	});
}

	$(document).ready(function(){

		$('#Jadwal_jam_mulai, #Jadwal_jam_selesai').timepicker({
			
			stepMinute: 5,
			controlType: 'select',
			oneLine: true,
		});

		$('#Jadwal_jam_ke').change(function(){
			$.ajax({
				type : 'POST',
				data : 'term='+$(this).val(),
				url: "<?php echo Yii::app()->createUrl('jam/ajaxJam');?>",
				success : function(data){

					var data = JSON.parse(data);
                	$('#Jadwal_jam_mulai').val(data.jam_mulai);
                	$('#Jadwal_jam_selesai').val(data.jam_selesai);
				}

			});
			
		});


		$('#Jadwal_kampus, #Jadwal_hari, #Jadwal_jam_mulai').change(function(){
			cekKonflik();
		});

		
		var fak = $('#Jadwal_fakultas').val();
		findProdi(fak);

		$('#Jadwal_fakultas').change(function(){
			var fak = $(this).val();

			findProdi(fak);
		});

		$('#Jadwal_prodi').change(function(){
			var prodi = $(this).val();
			findMk(prodi);
			
		});


	$('#nama_dosen').autocomplete({
      minLength:1,
      select:function(event, ui){
       
        $('#Jadwal_kode_dosen').val(ui.item.id);
        $('#nama_dosen').val(ui.item.value);
                
      },
      
      focus: function (event, ui) {
        $('#Jadwal_kode_dosen').val(ui.item.id);
       $('#nama_dosen').val(ui.item.value);
      },
      source:function(request, response) {
        $.ajax({
                url: "<?php echo Yii::app()->createUrl('Jadwal/GetDosen');?>",
                dataType: "json",
                data: {
                    term: request.term,
                    
                },
                success: function (data) {
                    response(data);
                }
            })
        },
       
  }); 
	});
</script>