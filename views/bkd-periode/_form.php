<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BkdPeriode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bkd-periode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun_id',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'nama_periode',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_bkd_awal',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'tanggal_bkd_akhir',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'buka',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'created_at',['options' => ['tag' => false]])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
