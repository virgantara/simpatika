<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanFungsional */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-fungsional-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sister_id',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'NIY',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'sk_jabatan_fungsional',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'jabatan_fungsional',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'terhitung_mulai_tanggal_jabatan_fungsional',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'angka_kredit',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'kelebihan_pengajaran',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'kelebihan_penelitian',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'kelebihan_pengabdian_masyarakat',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'kelebihan_kegiatan_penunjang',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'id_jabfung',['options' => ['tag' => false]])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
