<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WewenangAjarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wewenang Ajars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wewenang-ajar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Wewenang Ajar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'jabatan_id',
                'value' => function($data){
                    return $data->jabatan->nama;
                }
            ],
            [
                'attribute' => 'kualifikasi_id',
                'value' => function($data){
                    return $data->kualifikasi->nama_lain2;
                }
            ],
            [
                'attribute' => 'prodi_id',
                'value' => function($data){
                    return $data->prodi->nama_lain2;
                }
            ],
            'wewenang',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
