<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenunjangLainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penunjang-lain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kategori_kegiatan_id') ?>

    <?= $form->field($model, 'komponen_kegiatan_id') ?>

    <?= $form->field($model, 'jenis_panitia_id') ?>

    <?= $form->field($model, 'tingkat_id') ?>

    <?php // echo $form->field($model, 'nama_kegiatan') ?>

    <?php // echo $form->field($model, 'instansi') ?>

    <?php // echo $form->field($model, 'no_sk_tugas') ?>

    <?php // echo $form->field($model, 'tanggal_mulai') ?>

    <?php // echo $form->field($model, 'tanggal_selesai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
