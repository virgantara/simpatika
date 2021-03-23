<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Penghargaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penghargaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bentuk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pemberi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun')->textInput() ?>

    <?= $form->field($model, 'f_penghargaan')->fileInput().'NB: File format is pdf, png, jpeg, jpg and maximal sized 1 MB<br><br>' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
