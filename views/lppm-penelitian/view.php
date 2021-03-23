<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\LppmPenelitian */

$this->title = 'Skema : '.$model->namaSkema;
$this->params['breadcrumbs'][] = ['label' => 'Penelitian', 'url' => ['index','jenis'=>$model->jenis_penelitian]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lppm-penelitian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
        if($model->ver == 0):
        ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); ?>
        <?php 
    endif;
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'namaSkema',
            'judul',
            'nIY.dataDiri.nama',
            'created',
            'file_proposal',
            'berita_acara',
        ],
    ]) ?>
     <p>
        <?php
        if($model->ver == 0)
         echo Html::a('Add Anggota', ['/lppm-penelitian-anggota/create','id'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nIY.dataDiri.nama',
            'anggota.nama',
            'beban_kerja',

            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                   'title'        => 'delete',
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method'  => 'post',
                        ]);
                    }
                ],
                 'urlCreator' => function ($action, $model, $key, $index) {
                    
                    if ($action === 'delete') {
                        $url =Url::to(['lppm-penelitian-anggota/delete','id'=>$model->id]);
                        return $url;
                    }

                    else if ($action === 'update') {
                        $url =Url::to(['lppm-penelitian-anggota/update','id'=>$model->id]);
                        return $url;
                    }

                    else if ($action === 'view') {
                        $url =Url::to(['lppm-penelitian-anggota/view','id'=>$model->id]);
                        return $url;
                    }

                },
                'visibleButtons' => [
                    'view' => function ($model) {
                        return $model->lppmPenelitian->ver == 0;
                    },
                    'update' => function ($model) {
                        return $model->lppmPenelitian->ver == 0;
                    },
                    'delete' => function ($model) {
                        return $model->lppmPenelitian->ver == 0;
                    },
                ]
            ],
        ],
    ]); ?>
</div>
