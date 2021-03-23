<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Prodi;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;

use \app\models\MJenjangPendidikan;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$listData = \app\models\MJabatanAkademik::getList();
$listDataJenjang = \app\models\MJenjangPendidikan::getList();
$listRoles = \app\rbac\models\AuthItem::find()->where(['<>','name','theCreator'])->all();
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); 
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
      echo '<div class="alert alert-' . $key . '">' . $message . '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
    }
    echo $form->errorSummary($model,['header'=>'<div class="alert alert-danger">','footer'=>'</div>']);
    echo $form->errorSummary($dataDiri,['header'=>'<div class="alert alert-danger">','footer'=>'</div>']);
    ?>
    <div class="row">
        <div class="col-md-4">
        <?= $form->field($dataDiri, 'nama')->textInput(['maxlength' => true]) ?>
        <?= $form->field($dataDiri, 'nik')->textInput(['maxlength' => true]) ?>
        

    <?= $form->field($dataDiri, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

      <?= $form->field($dataDiri, 'tanggal_lahir')->widget(
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
    <?= $form->field($dataDiri, 'gender')->radioList([ 'Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan', ], ['prompt' => '']) ?>
    <?= $form->field($dataDiri, 'agama')->radioList([ 'ISLAM' => 'ISLAM']) ?>
    
    <?= $form->field($dataDiri, 'status_kawin')->radioList([ 'Kawin' => 'Kawin', 'Belum Kawin' => 'Belum Kawin', 'Duda/Janda' => 'Duda/Janda', ], ['prompt' => '']) ?>
    <?= $form->field($dataDiri, 'alamat_rumah')->textInput(['maxlength' => true]) ?>
     <?= $form->field($dataDiri, 'telp_hp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label>Kode Unik</label><br>
            <?= $form->field($dataDiri, 'kode_unik',['options'=>['tag'=>false],'errorOptions' => ['tag' => null]])->textInput(['style' => 'width:120px','class'=>''])->label(false) ?>
            <?=Html::a('<i class="fa fa-refresh"></i> Generate Kode (Dosen LB)','javascript:void(0)',['class'=>'btn btn-primary','id'=>'btn-generate']);?><br>
            <small>Kode Unik dosen ini dipakai untuk semua sistem</small>
            </div>
            <?= $form->field($model, 'NIY')->textInput(['autofocus' => true]) ?>
            <?= $form->field($dataDiri, 'NIDN')->textInput(['maxlength' => true]) ?>
            <?= $form->field($dataDiri, 'jenjang_kode')->dropDownList($listDataJenjang, ['prompt' => '-Pilih Pendidikan Terakhir-']) ?>
    
            <?= $form->field($dataDiri, 'kampus')->dropDownList($listKampus, ['prompt' => '-Pilih Kampus-']) ?>
   
            <?= $form->field($model, 'id_prod')->dropDownList(
            ArrayHelper::map(Prodi::find()->all(),'ID','nama'),
            ['prompt'=>'Pilih Program Studi']
            ) 
        ?>

       <?= $form->field($dataDiri, 'status_dosen')->dropDownList([ '1' => 'Dosen Tetap', '2' => 'Tidak Tetap'], ['prompt' => '- Pilih Status Dosen -']) ?>
      <?= $form->field($dataDiri, 'jabatan_fungsional')->dropDownList($listData, ['prompt'=>'..Pilih Jabatan Fungsional..','id'=>'jabfung']); ?>
    <?php

    $data = !$dataDiri->isNewRecord ? [$dataDiri->pangkat => $dataDiri->pangkat0->nama.' '.$dataDiri->pangkat0->golongan] : [];
     echo $form->field($dataDiri, 'pangkat')->widget(DepDrop::classname(), [
        'data' => $data, 
        'options'=>['id'=>'pangkat'],
        'pluginOptions'=>[
            'depends'=>['jabfung'],
            'placeholder'=>'..Pilih Pangkat..',
            'url'=>\yii\helpers\Url::to(['/m-jabatan-akademik/get-pangkat'])
        ]
    ]);
     ?>

    
    
             
        </div>
        <div class="col-md-4">
              <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            
        <?= $form->field($model, 'access_role')->dropDownList(ArrayHelper::map($listRoles,'name','name')) ?>
    
        <?= $form->field($model, 'status')->dropDownList(['aktif'=>'Aktif','nonaktif'=>'Nonaktif']) ?>
    
    <?= $form->field($dataDiri, 'permalink')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>


<?php

$this->registerJs(' 
 
function makeid(length) {
   var result           = \'\';
   var characters       = \'ABCDEFGHIJKLMNOPQRSTUVWXYZ\';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

$(document).on("click","#btn-generate",function(e){
    e.preventDefault()

    $(this).prev().val(makeid(6))
})

', \yii\web\View::POS_READY);

?>
