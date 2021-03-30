<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PublikasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publikasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kegiatan_id') ?>

    <?= $form->field($model, 'judul_publikasi_paten') ?>

    <?= $form->field($model, 'nama_jenis_publikasi') ?>

    <?= $form->field($model, 'tanggal_terbit') ?>

    <?php // echo $form->field($model, 'sister_id') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
