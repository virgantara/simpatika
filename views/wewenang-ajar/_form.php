<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WewenangAjar */
/* @var $form yii\widgets\ActiveForm */
$listJenjang = ArrayHelper::map(\app\models\MJenjangPendidikan::find()->where('nama_lain2 IS NOT NULL')->all(),'id','nama_lain2');
$listJabatan = ArrayHelper::map(\app\models\MJabatanAkademik::find()->all(),'id','nama');
// $listJabatan = ArrayHelper::map(\common\models\MJabatanAkademik::find()->all(),'id','nama');

?>

<div class="wewenang-ajar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jabatan_id')->dropDownList($listJabatan) ?>

    <?= $form->field($model, 'kualifikasi_id')->dropDownList($listJenjang) ?>

    <?= $form->field($model, 'prodi_id')->dropDownList($listJenjang) ?>

    <?= $form->field($model, 'wewenang')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
