<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Organisasi */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Organisasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'organisasi',
            'jabatan',
            [
                'attribute' => 'kategori_kegiatan_id',
                'value' => function($data){
                    return !empty($data->kategoriKegiatan) ? $data->kategoriKegiatan->nama : '-';
                }
            ],
            
           
            [
                'attribute' => 'komponen_kegiatan_id',
                'value' => function($data){
                    return !empty($data->komponenKegiatan) ? $data->komponenKegiatan->nama : '-';
                }
            ],
            'tanggal_mulai_keanggotaan',
            'selesai_keanggotaan',
            'sister_id',
            'update_at',
            
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>