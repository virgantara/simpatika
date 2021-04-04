<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenugasanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penugasan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sister_id') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'status_pegawai') ?>

    <?= $form->field($model, 'nama_ikatan_kerja') ?>

    <?php // echo $form->field($model, 'nama_jenjang_pendidikan') ?>

    <?php // echo $form->field($model, 'unit_kerja') ?>

    <?php // echo $form->field($model, 'perguruan_tinggi') ?>

    <?php // echo $form->field($model, 'terhitung_mulai_tanggal_surat_tugas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
