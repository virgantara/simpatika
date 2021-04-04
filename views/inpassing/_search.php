<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InpassingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpassing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sister_id') ?>

    <?= $form->field($model, 'nama_golongan') ?>

    <?= $form->field($model, 'nomor_sk_inpassing') ?>

    <?= $form->field($model, 'tanggal_sk') ?>

    <?php // echo $form->field($model, 'sk_inpassing_terhitung_mulai_tanggal') ?>

    <?php // echo $form->field($model, 'NIY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
