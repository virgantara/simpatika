<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LppmPenelitianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lppm-penelitian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lppm_skema_penelitian_id') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'file_proposal') ?>

    <?php // echo $form->field($model, 'berita_acara') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
