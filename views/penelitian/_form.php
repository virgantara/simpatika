<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

$listSkim = ArrayHelper::map(\app\models\SkimKegiatan::find()->orderBy(['nama'=>SORT_ASC])->all(),'id','nama');
$listBidang = ArrayHelper::map(\app\models\KelompokBidang::find()->orderBy(['nama'=>SORT_ASC])->all(),'id','nama');

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

$listKegiatan = \app\helpers\MyHelper::convertKategoriKegiatan('1206');


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
        <label class="control-label col-md-3">Judul Pengabdian</label>
        <div class="col-md-9">
     <?= $form->field($model, 'judul_penelitian_pengabdian',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Kelompok Bidang</label>
        <div class="col-md-9">
        <?= $form->field($model, 'kelompok_bidang_id',['options' => ['tag' => false]])->widget(Select2::classname(), [
            'data' => $listBidang,

            'options'=>['placeholder'=>Yii::t('app','- Pilih Kelompok Bidang -')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false)?>    
       
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Jenis SKIM</label>
        <div class="col-md-9">
    <?= $form->field($model, 'skim_kegiatan_id',['options' => ['tag' => false]])->dropDownList($listSkim,['prompt'=>'- Pilih SKIM -'])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Lokasi Kegiatan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tempat_kegiatan',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tahun Usulan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tahun_usulan',['options' => ['tag' => false]])->dropDownList($years,['prompt'=>'- Pilih Tahun -'])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tahun Kegiatan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tahun_kegiatan',['options' => ['tag' => false]])->dropDownList($years,['prompt'=>'- Pilih Tahun -'])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tahun Pelaksanaan</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tahun_dilaksanakan',['options' => ['tag' => false]])->dropDownList($years,['prompt'=>'- Pilih Tahun -'])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Lama Kegiatan (Tahun)</label>
        <div class="col-md-9">
        <?= $form->field($model, 'durasi_kegiatan',['options' => ['tag' => false]])->textInput()->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tahun Pelaksanaan Ke</label>
        <div class="col-md-9">
        <?= $form->field($model, 'tahun_pelaksanaan_ke',['options' => ['tag' => false]])->textInput()->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Dana DIKTI</label>
        <div class="col-md-9">
        <?= $form->field($model, 'dana_dikti',['options' => ['tag' => false]])->textInput()->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Dana PT</label>
        <div class="col-md-9">
        <?= $form->field($model, 'dana_pt',['options' => ['tag' => false]])->textInput()->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Dana Institusi Lain</label>
        <div class="col-md-9">
        <?= $form->field($model, 'dana_institusi_lain',['options' => ['tag' => false]])->textInput()->label(false) ?>
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
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true
                ]
            ]
        )->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
