<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PenelitianAnggota */
/* @var $form yii\widgets\ActiveForm */
$listData = \common\models\DataDiri::getListDataDosen();


?>

<div class="penelitian-anggota-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'NIY')->dropDownList($listData, ['prompt'=>'..Pilih Dosen..','id'=>'stok_id']); ?>


    <?= $form->field($model, 'status_anggota')->textInput(['maxlength' => true,'placeholder'=>'Anggota 1/ Anggota 2, dst']) ?>

    <?= $form->field($model, 'beban_kerja')->textInput(['placeholder'=>'jam / minggu']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
