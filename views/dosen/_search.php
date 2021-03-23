<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Prodi;

/* @var $this yii\web\View */
/* @var $model frontend\models\DosenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dosen-search col-lg-4">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'NIY')->textInput() ?>
    
    <?= $form->field($model, 'namanya')->textInput() ?>

    <?= $form->field($model, 'id_prod')->dropDownList(
            ArrayHelper::map(Prodi::find()->all(),'ID','nama'),
            ['prompt'=>'Pilih Program Studi']
            ) 
    ?>
    
    <div class="form-group pull-right">
        <br>
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        &nbsp;
        <?= Html::a('Reset',['dosen/index'], ['class' => 'btn btn-default','type'=>'reset']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<br>
</div>
