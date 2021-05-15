<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\models\MPangkat;

/* @var $this yii\web\View */
/* @var $model common\models\DataDiri */
/* @var $form yii\widgets\ActiveForm */

$listTugasDosen = ArrayHelper::map(\app\models\TugasDosen::find()->all(),'id','nama');
$listData = \app\models\MJabatanAkademik::getList();
$listDataJenjang = \app\models\MJenjangPendidikan::getList();
$bidang_ilmu = !empty($model->bidangIlmu) && !empty($model->bidangIlmu->kode0) ? $model->bidangIlmu->kode0 : ''; 

$kepakaran_id_parent = !empty($model->kepakaran) && !empty($model->kepakaran->parent0) ? $model->kepakaran->parent : ''; 
?>

<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                Data Dosen di SIMPEG
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(); 
                foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                  echo '<div class="alert alert-' . $key . '">' . $message . '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
                }
                echo $form->errorSummary($model,['header'=>'<div class="alert alert-danger">','footer'=>'</div>']);
                
                ?>
                <?= $form->field($model, 'tugas_dosen_id')->dropDownList($listTugasDosen, ['prompt' => '-Pilih Tugas Dosen-']) ?>
                <?= $form->field($model, 'NIDN')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'gelar_depan')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'gelar_belakang')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'gender')->radioList([ 'Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan', ]) ?>

                <?= $form->field($model, 'kampus')->dropDownList($listKampus) ?>

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
                <?= $form->field($model, 'status_kawin')->dropDownList([ 'Kawin' => 'Kawin', 'Belum Kawin' => 'Belum Kawin', 'Duda/Janda' => 'Duda/Janda', ]) ?>

                <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'jabatan_fungsional')->dropDownList($listData, ['prompt'=>'..Pilih Jabatan Fungsional..','id'=>'jabfung']); ?>
                
                <div class="form-group">
                    <label class="control-label">Bidang Ilmu</label><div class="">
                    <?= Html::dropDownList('bidang_ilmu',$bidang_ilmu, ArrayHelper::map($listBidangIlmu,'kode',function($data){
                        return (!empty($data->kode0) ? $data->kode0->nama : '').' - '.$data->nama;
                    }),['prompt'=>'..Pilih Bidang Ilmu','id'=>'bidang_ilmu']); ?>
                        
                    <?php


                    echo $form->field($model, 'bidang_ilmu_id',['options'=>['tag'=>false]])->widget(DepDrop::classname(), [
                    'options' => ['id' => 'bidang_ilmu_id', 'placeholder' => '- Pilih Bidang Ilmu -','class'=>' '],
                    'pluginOptions'=>[
                        'depends'=>['bidang_ilmu'],
                        'class'=>'',
                        'url'=>\yii\helpers\Url::to(['/bidang-ilmu/get-bidang-ilmu'])
                    ]
                ])->label(false);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Bidang Kepakaran</label><div class="">
                    <?= Html::dropDownList('kepakaran_id_parent',$kepakaran_id_parent, ArrayHelper::map($listKepakaran,'kode',function($data){
                        return $data->kode.' - '.$data->nama;
                    }),['prompt'=>'..Pilih Bidang Kepakaran','id'=>'parent_kepakaran_id']); ?>
                        
                    <?php


                    echo $form->field($model, 'kepakaran_id',['options'=>['tag'=>false]])->widget(DepDrop::classname(), [
                    'options' => ['id' => 'kepakaran_id', 'placeholder' => '- Pilih Bidang Kepakaran -','class'=>' '],
                    'pluginOptions'=>[
                        'depends'=>['parent_kepakaran_id'],
                        'class'=>'',
                        'url'=>\yii\helpers\Url::to(['/bidang-kepakaran/get-bidang-kepakaran'])
                    ]
                ])->label(false);?>
                    </div>
                </div>
                <?= $form->field($model, 'expertise')->textInput(['maxlength' => true,'placeholder'=>'Jika lebih dari satu keahlian, pisahkan dengan tanda koma. Contoh: Machine Learning, Computer Vision']) ?>
                <?php

                $data = !$model->isNewRecord ? [$model->pangkat => $model->pangkat0->nama.' '.$model->pangkat0->golongan] : [];
                 echo $form->field($model, 'pangkat')->widget(DepDrop::classname(), [
                    'data' => $data, 
                    'options'=>['id'=>'pangkat'],
                    'pluginOptions'=>[
                        'depends'=>['jabfung'],
                        'placeholder'=>'..Pilih Pangkat..',
                        'url'=>\yii\helpers\Url::to(['/m-jabatan-akademik/get-pangkat'])
                    ]
                ]);
                 ?>
                 <?= $form->field($model, 'jenjang_kode')->dropDownList($listDataJenjang, ['prompt' => '-Pilih Jenjang-']) ?>
                 
                <?= $form->field($model, 'alamat_rumah')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'telp_hp')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'telegram_username')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'permalink')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model->nIY, 'sister_id')->textInput(['readonly' => true]) ?>

                <?= $form->field($model, 'f_foto')->fileInput().'NB: File format is png, jpeg, jpg and maximal sized 1 MB<br><br>' ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>                
            </div>
        </div>
    </div>
    <?php 
    if(!empty($results))
    {
    ?>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        Data Dosen di SISTER
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">NIDN</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nidn;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Nama</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nama_dosen;?>
                            </td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Jenis Kelamin</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->jenis_kelamin;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Tempat Lahir</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->tempat_lahir;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Tanggal Lahir</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=\app\helpers\MyHelper::convertTanggalIndo($results->tanggal_lahir);?></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e7eaec;">
                            <td class="col-lg-6 col-md-3 col-xs-12">Nama Ibu Kandung</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nama_ibu_kandung;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">No HP</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nomor_hp;?></td>
                            </tr>
                            </tbody>
                    
                        </table>
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        Kepegawaian
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Program Studi</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nama_program_studi;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Status Keaktifan</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->status_aktif_sekarang;?>
                            </td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Nomor SK TMMD</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->no_sk_pengangkatan;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Tanggal Mulai Menjadi Dosen (TMMD)</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=\app\helpers\MyHelper::convertTanggalIndo($results->sk_pengangkatan_terhitung_mulai_tanggal);?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Pangkat/Golongan</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nama_golongan;?></td>
                            </tr>
                           
                            </tbody>
                    
                        </table>
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        Kependudukan
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">NIK</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nik;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Agama</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nama_agama;?>
                            </td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Kewarganegaraan</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->kewarganegaraan;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Status Perkawinan</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->status_perkawinan;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Nama Suami/Istri</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nama_suami_istri;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Pekerjaan Suami/Istri</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->pekerjaan;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Alamat</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->alamat;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">RT/RW</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->no_rt.' / '.$results->no_rw;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Dusun</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->nama_dusun;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Desa</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->kelurahan;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Kota/Kabupaten</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->kota_kabupaten;?></td>
                            </tr>
                            <tr>
                            <td class="col-lg-6 col-md-3 col-xs-12">Provinsi</td>
                            <td>:</td>
                            <td class="col-lg-6 col-md-3 col-xs-12"><?=$results->provinsi;?></td>
                            </tr>

                            </tbody>
                    
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</div>


<?php 

$this->registerJs(' 

  
  $("#bidang_ilmu").trigger("change");

  setTimeout(function(){ $("#bidang_ilmu_id").val("'.$model->bidang_ilmu_id.'"); }, 200);

  $("#parent_kepakaran_id").trigger("change");

  setTimeout(function(){ $("#kepakaran_id").val("'.$model->kepakaran_id.'"); }, 200);

', \yii\web\View::POS_READY);

?>