<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PenunjangLain */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penunjang Lains', 'url' => ['index']];
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
            'kategori_kegiatan_id',
            'komponen_kegiatan_id',
            'jenis_panitia_id',
            'tingkat_id',
            'nama_kegiatan',
            'instansi',
            'no_sk_tugas',
            'tanggal_mulai',
            'tanggal_selesai',
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>