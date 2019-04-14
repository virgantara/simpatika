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
	'method' => 'get',
	'action' => $this->createUrl('krs/nilai'),
)); 
?>
	
	<div class="row">
		<label>Fakultas</label>
		<?php 
		$list = CHtml::listData(Masterfakultas::model()->findAll(), 'kode_fakultas', function($dsn) {
		    return ($dsn->nama_fakultas);
		});
		echo CHtml::dropDownList('fakultas',!empty($_GET['fakultas']) ? $_GET['fakultas'] : '',$list); 
		// echo $form->textField($model,'fakultas',array('size'=>7,'maxlength'=>7)); 
		?>
		
	</div>

	<div class="row">
		<label>Prodi</label>
		<?php 
		$prodis = array();

		echo CHtml::dropDownList('prodi',!empty($_GET['prodi']) ? $_GET['prodi'] : '',$prodis,array('empty' => '(Select a prodi)')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		
	</div>

	

	<div class="row">
		<label>Tahun Akademik</label>
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(array('order'=>'tahun_id DESC')), 'tahun_id', function($dsn) {
		    return ($dsn->tahun_id);
		});
		echo CHtml::dropDownList('tahun_akademik',!empty($_GET['tahun_akademik']) ? $_GET['tahun_akademik'] : '',$list); 
		// echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); 
		?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Cari KRS'); ?>
		<?php 
		if(!empty($_GET['prodi'])){
			echo CHtml::link('Export XLS',['krs/nilai','prodi'=>$_GET['prodi'],'tahun_akademik'=>$_GET['tahun_akademik'],'xls' =>1]);
		}
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
	$this->renderPartial('_tabel_nilai',[
		'model' =>$model,
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