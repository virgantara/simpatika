<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Prodi */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodi-view">

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
            'ID',
            'kode_prod',
            'nama',
            'fakultasProdi.nama',
            'aliasi',
        ],
    ]) ?>
    
<br><br>
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenProdi()]),
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'NIY',
//            'id_prod',
            'dosenData.nama',
            'dosenData.gender',
            'email:email',
            'dosenData.telp_hp',
            [
                'header' => 'Penelitian',
                'value' => 'jumlahPenelitian',
            ],
            [
                'header' => 'Pengabdian',
                'value' => 'jumlahPengabdian',
            ],
            [
                'header' => 'Kemahasiswaan',
                'value' => 'jumlahkegiatan',
            ],
            [
                'header' => 'Penghargaan',
                'value' => 'jumlahPenghargaan',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['dosen/'.$action, 'id' => $model->ID]);
                }
            ],
//            'status_admin',
//            'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'status',
            // 'created_at',
            // 'updated_at',
//            'totalPenelitian',

//            ['class' => 'yii\grid\ActionColumn',
//            'template'=>'{view} '
//            ],
        ],
    ]); ?>

</div>
