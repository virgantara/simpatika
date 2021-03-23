<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pengabdian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengabdian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bulan')->dropDownList([' '=>' ','1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' ]) ?>
    
    <?= $form->field($model, 'tahun')->textInput() ?>
    <?= $form->field($model, 'nilai')->textInput() ?>	
    <?= $form->field($model, 'tempat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
