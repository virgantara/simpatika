<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SimakJadwalTempSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simak-jadwal-temp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hari') ?>

    <?= $form->field($model, 'jam_ke') ?>

    <?= $form->field($model, 'jam') ?>

    <?= $form->field($model, 'jam_mulai') ?>

    <?php // echo $form->field($model, 'jam_selesai') ?>

    <?php // echo $form->field($model, 'kode_mk') ?>

    <?php // echo $form->field($model, 'nama_mk') ?>

    <?php // echo $form->field($model, 'kode_dosen') ?>

    <?php // echo $form->field($model, 'nama_dosen') ?>

    <?php // echo $form->field($model, 'kode_pengampu_nidn') ?>

    <?php // echo $form->field($model, 'nama_dosen_bernidn') ?>

    <?php // echo $form->field($model, 'semester') ?>

    <?php // echo $form->field($model, 'kelas') ?>

    <?php // echo $form->field($model, 'fakultas') ?>

    <?php // echo $form->field($model, 'nama_fakultas') ?>

    <?php // echo $form->field($model, 'prodi') ?>

    <?php // echo $form->field($model, 'nama_prodi') ?>

    <?php // echo $form->field($model, 'kd_ruangan') ?>

    <?php // echo $form->field($model, 'tahun_akademik') ?>

    <?php // echo $form->field($model, 'kuota_kelas') ?>

    <?php // echo $form->field($model, 'kampus') ?>

    <?php // echo $form->field($model, 'presensi') ?>

    <?php // echo $form->field($model, 'materi') ?>

    <?php // echo $form->field($model, 'bobot_formatif') ?>

    <?php // echo $form->field($model, 'bobot_uts') ?>

    <?php // echo $form->field($model, 'bobot_uas') ?>

    <?php // echo $form->field($model, 'bobot_harian1') ?>

    <?php // echo $form->field($model, 'bobot_harian') ?>

    <?php // echo $form->field($model, 'bentrok') ?>

    <?php // echo $form->field($model, 'bentrok_with') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
