<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kepangkatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kepangkatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NIY',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'sister_id',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'kode_golongan',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'nama_golongan',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'no_sk_pangkat',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'terhitung_mulai_tanggal_sk_pangkat',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'tanggal_sk_pengangkatan',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'masa_kerja_golongan_tahun',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'masa_kerja_golongan_bulan',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'id_pangkat_golongan',['options' => ['tag' => false]])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
