<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Penelitian */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->judul;
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
            
            'NIY',
            'judul',
            'tahun',
            'status',
            'nilai',
            'sumberdana',
            [
                'attribute'=>'f_penelitian',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_penelitian)){
            return
            Html::a('View', ['penelitian/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['penelitian/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
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
