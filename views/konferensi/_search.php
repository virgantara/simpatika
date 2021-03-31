<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KonferensiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konferensi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'penyelenggara') ?>

    <?php // echo $form->field($model, 'status_kehadiran') ?>

    <?php // echo $form->field($model, 'f_konferensi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>