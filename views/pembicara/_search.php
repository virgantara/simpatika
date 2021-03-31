<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PembicaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembicara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_pembicara') ?>

    <?= $form->field($model, 'id_induk_katgiat') ?>

    <?= $form->field($model, 'nama_kategori_kegiatan') ?>

    <?= $form->field($model, 'judul_makalah') ?>

    <?php // echo $form->field($model, 'nama_pertemuan_ilmiah') ?>

    <?php // echo $form->field($model, 'penyelenggara_kegiatan') ?>

    <?php // echo $form->field($model, 'tanggal_pelaksanaan') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'NIY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
