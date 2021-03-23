<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenelitianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penelitian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sumberdana') ?>

    <?php // echo $form->field($model, 'f_penelitian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
