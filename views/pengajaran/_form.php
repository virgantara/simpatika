<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pengajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matkul')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'program_pendidikan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jurusan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'institusi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_awal')->textInput() ?>

    <?= $form->field($model, 'tahun_akhir')->textInput() ?>

    <?= $form->field($model, 'f_penugasan')->fileInput().'NB: File format is pdf, png, jpeg, jpg and maximal sized 1 MB<br><br>' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
