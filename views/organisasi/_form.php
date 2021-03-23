<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Organisasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'organisasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_awal')->textInput() ?>

    <?= $form->field($model, 'tahun_akhir')->textInput(['maxlength' => true, 'placeholder'=>'2018 / Sekarang']) ?>

    <?= $form->field($model, 'f_sk')->fileInput().'NB: File format is pdf, png, jpeg, jpg and maximal sized 1 MB<br><br>' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
