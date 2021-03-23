<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Verify */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="verify-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'NIY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kategori')->textInput() ?>

    <?= $form->field($model, 'ID_data')->textInput() ?>

    <?= $form->field($model, 'ver')->dropDownList([ 'Belum Diverifikasi' => 'Belum Diverifikasi', 'Sudah Diverifikasi' => 'Sudah Diverifikasi', 'Ditolak' => 'Ditolak', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
