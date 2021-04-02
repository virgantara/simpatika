<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PengelolaJurnalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengelola-jurnal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'peran_dalam_kegiatan') ?>

    <?= $form->field($model, 'no_sk_tugas') ?>

    <?= $form->field($model, 'apakah_masih_aktif') ?>

    <?= $form->field($model, 'tgl_sk_tugas') ?>

    <?php // echo $form->field($model, 'tgl_sk_tugas_selesai') ?>

    <?php // echo $form->field($model, 'nama_media_publikasi') ?>

    <?php // echo $form->field($model, 'kategori_kegiatan_id') ?>

    <?php // echo $form->field($model, 'komponen_kegiatan_id') ?>

    <?php // echo $form->field($model, 'NIY') ?>

    <?php // echo $form->field($model, 'sister_id') ?>

    <?php // echo $form->field($model, 'sks_bkd') ?>

    <?php // echo $form->field($model, 'is_claimed') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
