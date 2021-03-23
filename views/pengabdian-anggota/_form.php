<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PengabdianAnggota */
/* @var $form yii\widgets\ActiveForm */
$listData = \common\models\DataDiri::getListDataDosen();


?>

<div class="pengabdian-anggota-form">

    <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'NIY')->dropDownList($listData, ['prompt'=>'..Pilih Dosen..','id'=>'stok_id']); ?>

    <?= $form->field($model, 'status_anggota')->textInput(['maxlength' => true]) ?>

   
    <?= $form->field($model, 'beban_kerja')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
