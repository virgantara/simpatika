<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pengajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajaran-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'f_penugasan')->fileInput().'NB: File format is pdf and maximum sized 3 MB' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
