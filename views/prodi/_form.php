<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Fakultas;

/* @var $this yii\web\View */
/* @var $model common\models\Prodi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prodi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_prod')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_fak')->dropDownList(
            ArrayHelper::map(Fakultas::find()->all(),'ID','nama'),
            ['prompt'=>'Pilih Fakultas']
            ) 
        ?>
    
    <?= $form->field($model, 'aliasi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
