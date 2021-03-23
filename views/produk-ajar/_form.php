<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProdukAjar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produk-ajar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matkul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program_pendidikan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_awal')->textInput() ?>

    <?= $form->field($model, 'tahun_akhir')->textInput(['maxlength' => true,'placeholder'=>'2018 / Sekarang']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
