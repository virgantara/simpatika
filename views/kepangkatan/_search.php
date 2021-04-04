<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KepangkatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kepangkatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'sister_id') ?>

    <?= $form->field($model, 'kode_golongan') ?>

    <?= $form->field($model, 'nama_golongan') ?>

    <?php // echo $form->field($model, 'no_sk_pangkat') ?>

    <?php // echo $form->field($model, 'terhitung_mulai_tanggal_sk_pangkat') ?>

    <?php // echo $form->field($model, 'tanggal_sk_pengangkatan') ?>

    <?php // echo $form->field($model, 'masa_kerja_golongan_tahun') ?>

    <?php // echo $form->field($model, 'masa_kerja_golongan_bulan') ?>

    <?php // echo $form->field($model, 'id_pangkat_golongan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
