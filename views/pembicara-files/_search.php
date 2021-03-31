<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PembicaraFilesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembicara-files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_dokumen') ?>

    <?= $form->field($model, 'nama_dokumen') ?>

    <?= $form->field($model, 'nama_file') ?>

    <?= $form->field($model, 'jenis_file') ?>

    <?= $form->field($model, 'tanggal_upload') ?>

    <?php // echo $form->field($model, 'nama_jenis_dokumen') ?>

    <?php // echo $form->field($model, 'tautan') ?>

    <?php // echo $form->field($model, 'keterangan_dokumen') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
