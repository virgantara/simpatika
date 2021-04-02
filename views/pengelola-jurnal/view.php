<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengelolaJurnal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengelola Jurnals', 'url' => ['index']];
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
            'peran_dalam_kegiatan',
            'no_sk_tugas',
            'apakah_masih_aktif',
            'tgl_sk_tugas',
            'tgl_sk_tugas_selesai',
            'nama_media_publikasi',
            'kategori_kegiatan_id',
            'komponen_kegiatan_id',
            'NIY',
            'sister_id',
            'sks_bkd',
            'is_claimed',
            'updated_at',
            'created_at',
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>