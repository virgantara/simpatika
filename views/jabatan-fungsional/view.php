<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanFungsional */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Fungsionals', 'url' => ['index']];
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
            'sister_id',
            'NIY',
            'sk_jabatan_fungsional',
            'jabatan_fungsional',
            'terhitung_mulai_tanggal_jabatan_fungsional',
            'angka_kredit',
            'kelebihan_pengajaran',
            'kelebihan_penelitian',
            'kelebihan_pengabdian_masyarakat',
            'kelebihan_kegiatan_penunjang',
            'id_jabfung',
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>