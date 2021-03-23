<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Jabatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->errorSummary($model,['header'=>'<div class="alert alert-danger">','footer'=>'</div>']);?>

    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'institusi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_awal')->textInput() ?>

    <?= $form->field($model, 'tahun_akhir')->textInput(['maxlength' => true, 'placeholder'=>'2018 / Sekarang']) ?>

    <?= $form->field($model, 'f_penugasan')->fileInput().'NB: File format is pdf, png, jpeg, jpg and maximal sized 1 MB<br><br>' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
