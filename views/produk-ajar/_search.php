<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProdukAjarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produk-ajar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'matkul') ?>

    <?= $form->field($model, 'program_pendidikan') ?>

    <?= $form->field($model, 'jenis') ?>

    <?php // echo $form->field($model, 'tahun_awal') ?>

    <?php // echo $form->field($model, 'tahun_akhir') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
