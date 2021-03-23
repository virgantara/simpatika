<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JurnalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'jenis_publikasi_id') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'nama_jurnal') ?>

    <?php // echo $form->field($model, 'pissn') ?>

    <?php // echo $form->field($model, 'eissn') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'nomor') ?>

    <?php // echo $form->field($model, 'halaman') ?>

    <?php // echo $form->field($model, 'tahun_terbit') ?>

    <?php // echo $form->field($model, 'berkas') ?>

    <?php // echo $form->field($model, 'sumber_dana') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
