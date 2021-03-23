<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DataDiriSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-diri-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'status_kawin') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'pangkat') ?>

    <?php // echo $form->field($model, 'jabatan_fungsional') ?>

    <?php // echo $form->field($model, 'perguruan_tinggi') ?>

    <?php // echo $form->field($model, 'alamat_kampus') ?>

    <?php // echo $form->field($model, 'telp_kampus') ?>

    <?php // echo $form->field($model, 'fax_kampus') ?>

    <?php // echo $form->field($model, 'alamat_rumah') ?>

    <?php // echo $form->field($model, 'telp_hp') ?>

    <?php // echo $form->field($model, 'f_foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
