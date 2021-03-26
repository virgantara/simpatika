<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Jabatan */
/* @var $form yii\widgets\ActiveForm */
$listJabatan = ArrayHelper::map(\app\models\MJabatan::find()->orderBy(['nama'=>SORT_ASC])->all(),'id','nama');
$listUnit = ArrayHelper::map(\app\models\UnitKerja::find()->orderBy(['nama'=>SORT_ASC])->all(),'id','nama');

$nama_dosen = '';
if(!$model->isNewRecord){
    $nama_dosen = $model->nIY->dataDiri->nama;
}
?>

<div class="jabatan-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
      echo '<div class="alert alert-' . $key . '">' . $message . '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
    }
   
    ?>
    <div class="form-group">
    <label class="control-label">Nama Dosen</label>
    <?= $form->field($model, 'NIY',['options'=>['tag' => false]])->hiddenInput(['id'=>'dosen_id'])->label(false) ?>
   
    </div>
    <?= $form->field($model, 'unker_id')->dropDownList($listUnit,['prompt'=>'- Pilih Unit Kerja -']) ?>
    <?= $form->field($model, 'jabatan_id')->dropDownList($listJabatan,['prompt'=>'- Pilih Jabatan -']) ?>

    

    <?= $form->field($model, 'no_sk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_awal')->widget(
        DatePicker::className(),[
            'name' => 'tanggal', 
            'value' => date('d-m-Y', strtotime('0 days')),
            'options' => ['placeholder' => 'Pilih tanggal awal ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]
    ) ?>

    <?= $form->field($model, 'tanggal_akhir')->widget(
        DatePicker::className(),[
            'name' => 'tanggal', 
            'value' => date('d-m-Y', strtotime('0 days')),
            'options' => ['placeholder' => 'Pilih tanggal akhir ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]
    ) ?>

    <?= $form->field($model, 'f_penugasan')->fileInput(['maxlength' => true]) ?>

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
       
            $(this).parent().find("#dosen_id").val(ui.item.niy);
                
        },
      
        focus: function (event, ui) {
            $(this).parent().find("#dosen_id").val(ui.item.niy);
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
