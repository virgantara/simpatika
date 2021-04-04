<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanFungsionalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-fungsional-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sister_id') ?>

    <?= $form->field($model, 'NIY') ?>

    <?= $form->field($model, 'sk_jabatan_fungsional') ?>

    <?= $form->field($model, 'jabatan_fungsional') ?>

    <?php // echo $form->field($model, 'terhitung_mulai_tanggal_jabatan_fungsional') ?>

    <?php // echo $form->field($model, 'angka_kredit') ?>

    <?php // echo $form->field($model, 'kelebihan_pengajaran') ?>

    <?php // echo $form->field($model, 'kelebihan_penelitian') ?>

    <?php // echo $form->field($model, 'kelebihan_pengabdian_masyarakat') ?>

    <?php // echo $form->field($model, 'kelebihan_kegiatan_penunjang') ?>

    <?php // echo $form->field($model, 'id_jabfung') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
