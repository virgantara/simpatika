<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Penelitian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penelitian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([' '=>' ','Ketua' => 'Ketua', 'Anggota' => 'Anggota', 'Pribadi' => 'Pribadi', ]) ?>
    <?= $form->field($model, 'nilai')->textInput() ?>
    <?= $form->field($model, 'sumberdana')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'f_penelitian')->fileInput().'NB: File format is pdf, png, jpeg, jpg and maximal sized 1 MB<br><br>' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
