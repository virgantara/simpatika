<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UnitKerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-kerja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
    <label class="control-label">Nama Pejabat</label>
    <?= $form->field($model, 'pejabat_id',['options'=>['tag' => false]])->hiddenInput(['id'=>'pejabat_id'])->label(false) ?>
    <input type="text" class="nama_dosen form-control" placeholder="Ketik nama dosen" >
	</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

$this->registerJs(' 
 

$(document).bind("keyup.autocomplete",function(){
    $(".nama_dosen").autocomplete({
        minLength:1,
        select:function(event, ui){
       
            // $(this).prev().val(ui.item.nidn);
            $(this).parent().find("#pejabat_id").val(ui.item.id);
                
        },
      
        focus: function (event, ui) {
            // $(this).prev().val(ui.item.nidn);
            $(this).parent().find("#pejabat_id").val(ui.item.id);
        },
        source:function(request, response) {
            $.ajax({
                url: "'.Url::to(["data-diri/ajax-cari-dosen-simpeg"]).'",
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
', \yii\web\View::POS_READY);

?>
