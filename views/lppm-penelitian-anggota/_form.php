<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\LppmPenelitianAnggota */
/* @var $form yii\widgets\ActiveForm */

$listData = \common\models\DataDiri::getListDataDosen();
$listJenisAnggota = \common\models\LppmAnggota::getListJenisAnggota();

?>

<div class="lppm-penelitian-anggota-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $template = '<div><p class="repo-language">{{nama}}</p>' .
    '<p class="repo-name">{{niy}}</p>';
    echo \kartik\typeahead\Typeahead::widget([
    'name' => 'type_dosen',
    
    'options' => ['placeholder' => 'Ketik NIY atau Nama dosen ...'],
    'pluginOptions' => ['highlight'=>true],
    'pluginEvents' => [
        "typeahead:select" => "function(event,ui) { 
            $('#lppmpenelitiananggota-niy').val(ui.niy);
            $('#nama_dosen').val(ui.nama);

        }",
    ],
    
    'dataset' => [
        [
            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
            'display' => 'value',
            // 'prefetch' => $baseUrl . '/samples/countries.json',
            'remote' => [
                'url' => Url::to(['data-diri/get-dosen']) . '?q=%QUERY',
                'wildcard' => '%QUERY'
            ],
            'templates' => [
                'notFound' => '<div class="text-danger" style="padding:0 8px">Data tidak ditemukan.</div>',
                'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
            ]
        ]
    ]
]);
    
    ?>
  
    <?= $form->field($model, 'NIY')->textInput(); ?>
    <?= Html::label('Nama', 'nama_dosen') ?>
	<?= Html::textInput('nama_dosen', '', ['class' => 'form-control','id'=>'nama_dosen']) ?>

    <?= $form->field($model, 'anggota_id')->dropDownList($listJenisAnggota, ['prompt'=>'..Pilih Jenis Anggota..']); ?>
    

    <?= $form->field($model, 'beban_kerja')->textInput(['placeholder'=>'Jam/Minggu']) ?>

  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
