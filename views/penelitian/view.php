<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Penelitian */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->judul_penelitian_pengabdian;
$this->params['breadcrumbs'][] = ['label' => 'Penelitian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penelitian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'skim_kegiatan_id',
                'value' => function($data){
                    return !empty($data->skimKegiatan) ? $data->skimKegiatan->nama : '-';
                }
            ],
            'tahun_kegiatan',
            
             [
                'attribute' => 'kelompok_bidang_id',
                'value' => function($data){
                    return !empty($data->kelompokBidang) ? $data->kelompokBidang->nama : '-';
                }
            ],
            'no_sk_tugas',
            'tgl_sk_tugas',
            'durasi_kegiatan',
            'judul_penelitian_pengabdian',
            'tempat_kegiatan',
            'tahun_pelaksanaan_ke',
            'dana_dikti',
            'dana_pt',
            'dana_institusi_lain',
            
            
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
            
         
            'tahun_usulan',
            'tahun_dilaksanakan',
            
            'updated_at',
            'created_at',
        ],
    ]) ?>
     <p>
        <?= Html::a('Create Penelitian Anggota', ['penelitian-anggota/create','pid'=>$model->ID], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nIY.dataDiri.nama',
            'status_anggota',
            'beban_kerja',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
