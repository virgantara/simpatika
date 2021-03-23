<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PelatihanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelatihan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'tanggal_awal') ?>

    <?= $form->field($model, 'tanggal_akhir') ?>

    <?= $form->field($model, 'nama_pelatihan') ?>

    <?php // echo $form->field($model, 'penyelenggara') ?>

    <?php // echo $form->field($model, 'f_sertifikat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
