<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publikasi */
/* @var $form yii\widgets\ActiveForm */
$arr= [];
$is_readonly = ['class'=>'form-control','maxlength' => true];
if(!$model->isNewRecord)
{
    $listKatKeg = \app\models\KategoriKegiatan::find()->select(['id'])->where([
        'like','nama',$model->nama_kategori_kegiatan,false
    ])->asArray()->all();

    $is_readonly = ['class'=>'form-control','maxlength' => true,'readonly' =>'readonly'];

    foreach($listKatKeg as $k)
        $arr[] = $k['id'];
}

$listRubrikBkd = \app\models\KomponenKegiatan::find()->where(['IN','kondisi',$arr])->all();


?>

<div class="publikasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_kategori_kegiatan',['options' => ['tag' => false]])->textInput($is_readonly) ?>
    <?= $form->field($model, 'kegiatan_id',['options' => ['tag' => false]])->dropDownList(ArrayHelper::map($listRubrikBkd,'id',function($data){
        return $data->id.' - '.$data->subunsur;
    })) ?>



    <?= $form->field($model, 'judul_publikasi_paten',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'nama_jenis_publikasi',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_terbit',['options' => ['tag' => false]])->textInput() ?>

    <?= $form->field($model, 'sister_id',['options' => ['tag' => false]])->textInput($is_readonly) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
