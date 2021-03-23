<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerifySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Verification Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verify-index">

    <h1><?= Html::encode($this->title) ?></h1><br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->ver == 'Belum Diverifikasi'){
                return ['class'=>'warning'];
            }else if($model->ver == 'Ditolak'){
                return ['class'=>'danger'];
            }else{
                
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'NIY',
            [
                'attribute' => 'namanya',
                'value' => 'verifyData.nama',
            ],
            [
               'header' => 'Kategori Data',
               'value' => 'verifyKategori.Kategori',
               'filter' => Html::activeDropDownList($searchModel, 'kategori',$kategorinya,['class'=>'form-control','prompt' =>''])
            ],
//            'ID_data',
            'ver',
//            'verifyKategori.kategori',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to([$model->verifyKategori->base.'/'.$action, 'id' => $model->ID_data]);
                }
            ],
        ],
    ]); ?>
</div>
