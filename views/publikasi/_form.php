<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Publikasi */
/* @var $form yii\widgets\ActiveForm */
$arr= [];
$is_readonly = ['class'=>'form-control','maxlength' => true];
$query = \app\models\KomponenKegiatan::find();
$query->alias('p');
$query->select(['p.nama']);
$query->joinWith(['unsur as u']);
$query->where([
  'u.kode' => 'RISET'
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

$listKegiatan = \app\helpers\MyHelper::convertKategoriKegiatan('120');

// echo '<pre>';
// print_r($listKegiatan);
// echo '</pre>';
// exit;

$listJenisPublikasi = ArrayHelper::map(\app\models\JenisPublikasi::find()->all(),'id','nama');


?>

<div class="publikasi-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <label class="control-label col-md-3">Nama Kategori Kegiatan</label>
        <div class="col-md-9">
    <?= $form->field($model, 'nama_kategori_kegiatan',['options' => ['tag' => false]])->textInput($is_readonly)->label(false) ?>
</div></div>
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
        <label class="control-label col-md-3">Jenis Publikasi</label>
        <div class="col-md-9">
            <?= $form->field($model, 'jenis_publikasi_id',['options' => ['tag' => false]])->widget(Select2::classname(), [
            'data' => $listJenisPublikasi,

            'options'=>['placeholder'=>Yii::t('app','- Pilih Jenis Publikasi -')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false)?> 
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Judul Publikasi</label>
        <div class="col-md-9">
        <?= $form->field($model, 'judul_publikasi_paten',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Komponen Kegiatan BKD</label>
        <div class="col-md-9">
        <?= $form->field($model, 'kegiatan_id',['options' => ['tag' => false]])->widget(Select2::classname(), [
            'data' => $listKomponenKegiatan,

            'options'=>['placeholder'=>Yii::t('app','- Pilih Komponen Kegiatan -')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false)?>
       
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tanggal Terbit</label>
        <div class="col-md-9">
    <?= $form->field($model, 'tanggal_terbit',['options' => ['tag' => false]])->widget(
            DatePicker::className(),[
                'name' => 'tanggal_terbit', 
                'value' => date('Y-m-d', strtotime('0 days')),
                'options' => ['placeholder' => 'Pilih tanggal  ...'],
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
        <label class="control-label col-md-3">Volume</label>
        <div class="col-md-9">
        <?= $form->field($model, 'volume',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Nomor</label>
        <div class="col-md-9">
        <?= $form->field($model, 'nomor',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Halaman</label>
        <div class="col-md-9">
        <?= $form->field($model, 'halaman',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Penerbit</label>
        <div class="col-md-9">
        <?= $form->field($model, 'penerbit',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">DOI</label>
        <div class="col-md-9">
        <?= $form->field($model, 'doi',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">ISSN</label>
        <div class="col-md-9">
        <?= $form->field($model, 'issn',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tautan Laman Jurnal</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tautan',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
