<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

$query = \app\models\KomponenKegiatan::find();
$query->alias('p');
$query->select(['p.nama']);
$query->joinWith(['unsur as u']);
$query->where([
  'u.kode' => 'PENUNJANG'
]);
$query->groupBy(['p.nama']);
$query->orderBy(['p.nama'=>SORT_ASC]);

$listKomponen = $query->all();
// $listKomponen = ArrayHelper::map($listKomponen,'id',function($data){
//     return $data->subunsur;
// });
$listKomponenKegiatan = [];

foreach($listKomponen as $k)
{
    $list = \app\models\KomponenKegiatan::find()->where(['nama'=>$k->nama])->all();
   
    $tmp = [];
    foreach($list as $item)
    {
        $tmp[$item->id] = $item->subunsur.' - AK: '.$item->angka_kredit;
    }

    $listKomponenKegiatan[$k->nama] = $tmp;
}

$listKegiatan = \app\helpers\MyHelper::convertKategoriKegiatan('140');


// echo '<pre>';
// print_r($temp);
// echo '</pre>';
// exit;

$years = array_combine(range(date("Y"), 2006), range(date("Y"), 2006));

/* @var $this yii\web\View */
/* @var $model app\models\Pengabdian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengabdian-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php 
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
      echo '<div class="alert alert-' . $key . '">' . $message . '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
    }
    ?>
    <div class="form-group">
        <label class="control-label col-md-3">Kategori Kegiatan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'kategori_kegiatan_id',['options' => ['tag' => false]])->widget(Select2::classname(), [
            'data' => $listKegiatan,

            'options'=>['placeholder'=>Yii::t('app','- Pilih Kategori Kegiatan -')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false)?>
       
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Komponen Kegiatan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'komponen_kegiatan_id',['options' => ['tag' => false]])->widget(Select2::classname(), [
            'data' => $listKomponenKegiatan,

            'options'=>['placeholder'=>Yii::t('app','- Pilih Komponen Kegiatan -')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false)?>
       
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Peran dalam Kegiatan</label>
        <div class="col-md-9">
     <?= $form->field($model, 'peran_dalam_kegiatan',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Nama Media Publikasi</label>
        <div class="col-md-9">
        <?= $form->field($model, 'nama_media_publikasi',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">No SK Penugasan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'no_sk_tugas',['options' => ['tag' => false]])->textInput()->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tgl SK Penugasan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tgl_sk_tugas',['options' => ['tag' => false]])->widget(
            DatePicker::className(),[
                'name' => 'tgl_sk_tugas', 
                'value' => date('Y-m-d', strtotime('0 days')),
                'options' => ['placeholder' => 'Pilih tanggal SK ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]
        )->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tgl SK Penugasan Selesai</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tgl_sk_tugas_selesai',['options' => ['tag' => false]])->widget(
            DatePicker::className(),[
                'name' => 'tgl_sk_tugas_selesai', 
                'value' => date('Y-m-d', strtotime('0 days')),
                'options' => ['placeholder' => 'Pilih tanggal SK ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]
        )->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Masih aktif?</label>
        <div class="col-md-9">
        <?= $form->field($model, 'apakah_masih_aktif',['options' => ['tag' => false]])->radioList(['1' => 'Ya','0'=>'Tidak'])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
