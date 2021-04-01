<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$listSkim = ArrayHelper::map(\app\models\SkimKegiatan::find()->orderBy(['nama'=>SORT_ASC])->all(),'id','nama');
$listBidang = ArrayHelper::map(\app\models\KelompokBidang::find()->orderBy(['nama'=>SORT_ASC])->all(),'id','nama');
$listKategori = ArrayHelper::map(\app\models\KategoriKegiatan::find()->where(['like','id','130%',false])->orderBy(['nama'=>SORT_ASC])->all(),'id','nama');

/* @var $this yii\web\View */
/* @var $model app\models\Pengabdian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengabdian-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?= $form->field($model, 'judul_penelitian_pengabdian',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'nama_tahun_ajaran',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'skim_kegiatan_id',['options' => ['tag' => false]])->dropDownList($listSkim) ?>

     <?= $form->field($model, 'kategori_kegiatan_id',['options' => ['tag' => false]])->dropDownList($listKategori) ?>

      <?= $form->field($model, 'kelompok_bidang_id',['options' => ['tag' => false]])->dropDownList($listBidang) ?>

    <?= $form->field($model, 'durasi_kegiatan',['options' => ['tag' => false]])->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
