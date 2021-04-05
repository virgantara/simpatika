<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BkdPeriodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bkd-periode-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tahun_id') ?>

    <?= $form->field($model, 'nama_periode') ?>

    <?= $form->field($model, 'tanggal_bkd_awal') ?>

    <?= $form->field($model, 'tanggal_bkd_akhir') ?>

    <?= $form->field($model, 'buka') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
