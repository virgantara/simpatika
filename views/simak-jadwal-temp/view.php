<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SimakJadwalTemp */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Simak Jadwal Temps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

            <div class="panel-body ">
        
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hari',
            'jam_ke',
            'jam',
            'jam_mulai',
            'jam_selesai',
            'kode_mk',
            'nama_mk',
            'kode_dosen',
            'nama_dosen',
            'kode_pengampu_nidn',
            'nama_dosen_bernidn',
            'semester',
            'kelas',
            'fakultas',
            'nama_fakultas',
            'prodi',
            'nama_prodi',
            'kd_ruangan',
            'tahun_akademik',
            'kuota_kelas',
            'kampus',
            'presensi:ntext',
            'materi',
            'bobot_formatif',
            'bobot_uts',
            'bobot_uas',
            'bobot_harian1',
            'bobot_harian',
            'bentrok',
            'bentrok_with',
            'created',
            'modified',
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>