<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publikasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publikasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kegiatan_id',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'judul_publikasi_paten',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'nama_jenis_publikasi',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_terbit',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'sister_id',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
