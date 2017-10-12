<?php
/* @var $this JadwalController */
/* @var $model Jadwal */
/* @var $form CActiveForm */
?>

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui-timepicker-addon.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui-timepicker-addon.min.css"> 


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
		}

	});
}

	$(document).ready(function(){

		$('#Jadwal_jam_mulai, #Jadwal_jam_selesai').timepicker({
			
			stepMinute: 5,
			controlType: 'select',
			oneLine: true,
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
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kampus'); ?>
		<?php 
		$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus','nama_kampus');
		
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

		<?php 
		
		echo $form->textField($model,'jam_mulai',array('size'=>20,'maxlength'=>20)); 
		?>
		<?php echo $form->error($model,'jam_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jam_selesai'); ?>
		<?php echo $form->textField($model,'jam_selesai',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jam_selesai'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'fakultas'); ?>
		<?php 
		$list = CHtml::listData(Masterfakultas::model()->findAll(), 'kode_fakultas', function($dsn) {
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
		$prodis = array();
		echo $form->dropDownList($model,'prodi',$prodis,array('empty' => '(Select a prodi)')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		<?php echo $form->error($model,'prodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_mk'); ?>
		<?php 

		

		// $listmk = CHtml::listData(Mastermatakuliah::model()->findAllByAttributes(array('tahun_akademik'=>$tahunaktif)), 'nama_mata_kuliah', function($mk) {
		//     return ($mk->kode_mata_kuliah . ' - '. $mk->nama_mata_kuliah);
		// });

		$mks = array();
		echo $form->dropDownList($model,'kode_mk',$mks,array('empty' => '(Select a mk)')); 
		// echo $form->dropDownList($model,'kode_mk',$listmk); 
		?>
		<?php echo $form->error($model,'kode_mk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_dosen'); ?>
		<?php

		
		echo $form->hiddenField($model,'kode_dosen',array('size'=>20,'maxlength'=>20));
		echo CHtml::textField('nama_dosen','',array('size'=>20,'maxlength'=>20)); 
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
		<?php echo $form->labelEx($model,'kd_ruangan'); ?>
		<?php echo $form->textField($model,'kd_ruangan',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kd_ruangan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun_akademik'); ?>
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(array('order'=>'tahun_id DESC')), 'tahun_id', function($dsn) {
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