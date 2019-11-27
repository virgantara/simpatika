
<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'method' => 'get',
	'htmlOptions'=>array(
		'class'=>'form-horizontal'
	),
	'action' => $this->createUrl('jadwal/syncJadwal'),
)); 
?>


	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Tahun Akademik</label>
		<?php 
		$list = CHtml::listData(Tahunakademik::model()->findAll(array('order'=>'tahun_id DESC')), 'tahun_id', function($dsn) {
		    return ($dsn->tahun_id);
		});
		?>
		<div class="col-sm-9">
		<?php
		echo CHtml::dropDownList('tahun_akademik','',$list); 
		// echo $form->textField($model,'tahun_akademik',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>


	
	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit" id="btn-sync">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Sync Now
          </button>
	  </div>
      </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn-sync').click(function(e){
			e.preventDefault();
			
			Swal.fire({
			  title: 'Sinkronisasi Jadwal ke SIAKAD',
			  // input: 'text',
			  // inputAttributes: {
			  //   autocapitalize: 'off'
			  // },
			  width: '30%',
			  showCancelButton: true,
			  // cancelButtonText: 'Batalkan',
			  confirmButtonText: 'Sync Now',
			  showLoaderOnConfirm: true,
			  preConfirm: () => {
			    return fetch('<?=Yii::app()->createUrl('jadwal/ajaxSync');?>&ta='+$('#tahun_akademik').val(),{
			    	
			      })
			      .then(response => {
			        if (!response.ok) {
			          throw new Error(response.statusText)
			        }
			        return response.json()
			      })
			      .catch(error => {
			        Swal.showValidationMessage(
			          `Request failed: ${error}`
			        )
			      })
			  },
			  allowOutsideClick: () => !Swal.isLoading()
			}).then((result) => {
			  if (result.value) {
			  	if(result.value.code == 200){
			  		Swal.fire({
					  icon: 'success',
					  title: 'Yeay',
					  text: result.value.message,
					});	
			  	}

			  	else{
			  		Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: result.value.message,
					});
			  	}
			  	
			  }
			});

		});
	});
</script>
