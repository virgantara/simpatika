<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Pengabdian */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->nama_kegiatan;
$this->params['breadcrumbs'][] = ['label' => 'Pengabdian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengabdian-view">

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
            'NIY',
            'nama_kegiatan',
            'bulan',
            'tahun',
            'tempat',
            'nilai',
            'ver',
        ],
    ]) ?>
 <p>
        <?= Html::a('Create Pengabdian Anggota', ['pengabdian-anggota/create','pid'=>$model->ID], ['class' => 'btn btn-success']) ?>
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
