<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
 use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\CatatanHarian */
/* @var $form yii\widgets\ActiveForm */
$listUnsur = \app\models\UnsurKegiatan::find()->where(['jenis_pegawai' => Yii::$app->user->identity->access_role])->all();
?>

<div class="catatan-harian-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'unsur_id',['options' => ['tag' => false]])->dropDownList(
        ArrayHelper::map($listUnsur,'id','nama')
    ) ?>
    <?= $form->field($model, 'tanggal',['options' => ['tag' => false]])->widget(DatePicker::className(),[
        'readonly' => true,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
        ]
     ]) ?>
    <?= $form->field($model, 'deskripsi',['options' => ['tag' => false]])->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'advance',  

    ]); ?>
  
     
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
