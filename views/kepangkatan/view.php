<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kepangkatan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kepangkatans', 'url' => ['index']];
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
            'NIY',
            'sister_id',
            'kode_golongan',
            'nama_golongan',
            'no_sk_pangkat',
            'terhitung_mulai_tanggal_sk_pangkat',
            'tanggal_sk_pengangkatan',
            'masa_kerja_golongan_tahun',
            'masa_kerja_golongan_bulan',
            'id_pangkat_golongan',
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>