<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pengajaran */
/* @var $form yii\widgets\ActiveForm */

$list_jenis = ['SK Mengajar','Presensi','Nilai','Jurnal Ajar'];
$list_jenis = array_combine($list_jenis, $list_jenis);

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				Unggah Bukti Pengajaran
			</div>
			<div class="panel-body">
				<?php 
			    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			      echo '<div class="alert alert-' . $key . '">' . $message . '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
			    }
			    ?>
			    <?php $form = ActiveForm::begin([
			    	'options'=>['enctype'=>'multipart/form-data']
			    ]); ?>
			    <?= $form->errorSummary($fileBukti,['header'=>'<div class="alert alert-danger">','footer'=>'</div>']);?>  
			    <div class="form-group">
			    	<label for="" class="control-label col-md-3">Jenis Bukti</label>
			    	<div class="col-md-9">
			    		<?= $form->field($fileBukti, 'nama_jenis_dokumen',['options'=>['tag'=>false]])->dropDownList($list_jenis)->label(false) ?>
			    			
			    	</div>
			    </div>
			    
			    <div class="form-group">
			    	<label for="" class="control-label col-md-3">File Bukti</label>
			    	<div class="col-md-9">
			    		<?= $form->field($fileBukti, 'tautan',['options'=>['tag'=>false]])->fileInput()->label(false) ?>
			    		
			    	</div>
			    </div>

			    NB: File format is pdf and maximum sized 1 MB	
			    <div class="form-group col-md-offset-3">
			        <?= Html::submitButton('Upload Now', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			    </div>

			    <?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
