<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PengabdianAnggotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengabdian-anggota-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'status_anggota') ?>

    <?= $form->field($model, 'pengabdian_id') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'beban_kerja') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
