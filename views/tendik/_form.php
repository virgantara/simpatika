<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tendik */
/* @var $form yii\widgets\ActiveForm */

use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;

use \app\models\MJenjangPendidikan;
/* @var $this yii\web\View */
/* @var $model common\models\DataDiri */
/* @var $form yii\widgets\ActiveForm */

$listData = \app\models\MJabatanTendik::getList();
$listDataJenjang = \app\models\MJenjangPendidikan::getList();
$listDataUnitKerja = \app\models\UnitKerja::getList();
$listDataJenisTendik = \app\models\JenisTendik::getList();
?>

<div class="tendik-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="col-lg-6">
    <?= $form->field($model, 'NIY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'unit_id')->dropDownList($listDataUnitKerja, ['prompt'=>'..Pilih Unit Kerja..']); ?>
    <?= $form->field($model, 'jenis_tendik_id')->dropDownList($listDataJenisTendik, ['prompt'=>'..Pilih Jenis Tendik..']); ?>   
    <?= $form->field($model, 'jenjang_kode')->dropDownList($listDataJenjang, ['prompt' => '-Pilih Jenjang-']) ?>
    <?= $form->field($model, 'jabatan_id')->dropDownList($listData, ['prompt'=>'..Pilih Jabatan..']); ?>
</div>
<div class="col-lg-6">
    <?= $form->field($model, 'gender')->dropDownList([ 'Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(
        DatePicker::className(),[
            'name' => 'tanggal', 
            'value' => date('d-m-Y', strtotime('0 days')),
            'options' => ['placeholder' => 'Pilih tanggal lahir ...'],
            'pluginOptions' => [
                'format' => 'dd-mm-yyyy',
                'todayHighlight' => true
            ]
        ]
    ) ?>
    
    

    <?= $form->field($model, 'agama')->dropDownList([ 'ISLAM' => 'ISLAM']) ?>
     <?= $form->field($model, 'status_kawin')->dropDownList([ 'Kawin' => 'Kawin', 'Belum Kawin' => 'Belum Kawin', 'Duda/Janda' => 'Duda/Janda', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'alamat_rumah')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'telp_hp')->textInput(['maxlength' => true]) ?>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
