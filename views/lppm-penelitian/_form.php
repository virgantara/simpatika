<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\LppmPenelitian */
/* @var $form yii\widgets\ActiveForm */
$listData = \common\models\LppmSkemaPenelitian::getListSkema($jenis);

?>

<div class="lppm-penelitian-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <?= $form->field($model, 'lppm_skema_penelitian_id')->dropDownList($listData,['prompt'=>'.: Pilih Jenis Skema :.']) ?>
   
    <?= $form->field($model, 'judul')->textArea(['maxlength' => true]) ?>

    <?php 
    if(!$model->isNewRecord):
        $url = Yii::$app->params['front'];
        
   echo  $form->field($model, 'file_proposal')->widget(FileInput::className(), [
        'options' => ['accept' => ''],
        'pluginOptions' => [
            'showRemove'=> false,
            'showUpload' => false,
            'showCancel' => false,
            'overwriteInitial' => false,
            // 'initialPreviewConfig' => $json,
            // 'previewFileType' => 'pdf',
            // 'initialPreview' => $img,
            'uploadAsync'=> true,
            'maxFileSize' => 1*1024*1024,
            'deleteUrl' => \yii\helpers\Url::to(['/lppm-penelitian/delete-upload']),
            'allowedExtensions' => ['pdf','docx','doc','jpg'],
        ]
    ]); 

    echo  $form->field($model, 'berita_acara')->widget(FileInput::className(), [
        'options' => ['accept' => ''],
        'pluginOptions' => [
            'showRemove'=> false,
            'showUpload' => false,
            'showCancel' => false,
            'overwriteInitial' => false,
            // 'initialPreviewConfig' => $json,
            // 'previewFileType' => 'pdf',
            // 'initialPreview' => $img,
            'uploadAsync'=> true,
            'maxFileSize' => 1*1024*1024,
            'deleteUrl' => \yii\helpers\Url::to(['/lppm-penelitian/delete-upload']),
            'allowedExtensions' => ['pdf','docx','doc','jpg'],
        ]
    ]); 
    else:
    echo    $form->field($model, 'file_proposal')->widget(FileInput::classname(), [
        'options' => ['accept' => ''],
        'pluginOptions' => [
            'showUpload' => false,
        ]
    ]);

     echo    $form->field($model, 'berita_acara')->widget(FileInput::classname(), [
        'options' => ['accept' => ''],
        'pluginOptions' => [
            'showUpload' => false,
        ]
    ]);
    endif;
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
