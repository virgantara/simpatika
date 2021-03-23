<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengajaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'matkul') ?>

    <?= $form->field($model, 'program_pendidikan') ?>

    <?= $form->field($model, 'jurusan') ?>

    <?php // echo $form->field($model, 'institusi') ?>

    <?php // echo $form->field($model, 'program') ?>

    <?php // echo $form->field($model, 'tahun_awal') ?>

    <?php // echo $form->field($model, 'tahun_akhir') ?>

    <?php // echo $form->field($model, 'f_penugasan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
