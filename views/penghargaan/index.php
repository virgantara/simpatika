<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenghargaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Penghargaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penghargaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
//            'NIY',
            'bentuk',
            'pemberi',
            'tahun',
//            'f_penghargaan',
            [
                'attribute'=>'f_penghargaan',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_penghargaan)){
            return
            Html::a('View', ['penghargaan/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['penghargaan/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            [
                'attribute' => 'ver',
                'format' => 'raw',
                'filter' => ['Belum Diverifikasi' => 'Belum Diverivikasi', 'Sudah Diverifikasi' => 'Sudah Diverifikasi','Ditolak' => 'Ditolak']
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'Action'],
        ],
    ]); ?>
</div>
