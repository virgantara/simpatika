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
	'method' => 'get',
	'action' => $this->createUrl('krs/ekd'),
)); 
?>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Kampus</label>
			<div class="col-sm-9 col-lg-4">
		<?php 
		$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus', 'nama_kampus');
		echo CHtml::dropDownList('kampus',!empty($_GET['kampus']) ? $_GET['kampus'] : '',$list,array('empty' => '(Pilih Kampus)','class'=>'form-control')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Fakultas</label>
			<div class="col-sm-9 col-lg-4">
		<?php 
		$list = CHtml::listData(Masterfakultas::model()->findAll(), 'kode_fakultas', function($dsn) {
		    return ($dsn->nama_fakultas);
		});
		echo CHtml::dropDownList('fakultas',!empty($_GET['fakultas']) ? $_GET['fakultas'] : '',$list,['class'=>'form-control']); 
		// echo $form->textField($model,'fakultas',array('size'=>7,'maxlength'=>7)); 
		?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Prodi</label>
			<div class="col-sm-9 col-lg-4">
		<?php 
		$prodis = array();

		echo CHtml::dropDownList('prodi',!empty($_GET['prodi']) ? $_GET['prodi'] : '',$prodis,array('empty' => '(Pilih  prodi)','class'=>'form-control')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>

	

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Tahun Akademik</label>
			<div class="col-sm-9 col-lg-4">
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(array('order'=>'tahun_id DESC')), 'tahun_id', function($dsn) {
		    return ($dsn->tahun_id);
		});
		echo CHtml::dropDownList('tahun_akademik',!empty($_GET['tahun_akademik']) ? $_GET['tahun_akademik'] : '',$list,['class'=>'form-control']); 
		// echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); 
		?>
	</div>
	</div>

	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit">
            <i class="ace-icon glyphicon glyphicon-search bigger-110"></i>
            Cari 
          </button>
          <?php 
		if(!empty($_GET['prodi'])){
			echo CHtml::link('<i class="glyphicon glyphicon-download"></i> Export XLS',['krs/ekd','prodi'=>$_GET['prodi'],'tahun_akademik'=>$_GET['tahun_akademik'],'kampus'=>$_GET['kampus'],'xls' =>1],['class' => 'btn btn-success']);
		}
		?>
		</div>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
	$this->renderPartial('_tabel_ekd',[
		'result' =>$result,
		'xls' => $xls
	]);
?>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>

<script type="text/javascript">

function findProdi(fak){
	$.ajax({
		type : 'POST',
		data : 'q='+fak,
		url : '<?php echo Yii::app()->createUrl('jadwal/getProdi');?>',
		success : function(data){
			$('#prodi').empty();

			var jsondata = JSON.parse(data);


			var row = '';
			$.each(jsondata,function(i,item){
				row += '<option value="'+i+'">'+item+'</option>';
			});

			$('#prodi').append(row);

			<?php 
			if(!empty($_GET['prodi'])){
				echo "$('#prodi').val(".$_GET['prodi'].")";				
			}
			?>
			

		}

	});
}

	$(document).ready(function(){

		
		
		var fak = $('#fakultas').val();
		findProdi(fak);

		$('#fakultas').change(function(){
			var fak = $(this).val();

			findProdi(fak);
		});

		$('#prodi').change(function(){
			var prodi = $(this).val();
			findMk(prodi);
			
		});


	});
</script>