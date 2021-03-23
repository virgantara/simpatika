<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MakalahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Makalah / Poster';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="makalah-index">

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
            'judul',
            'penyelenggara',
            'tahun',
//            'f_makalah',
            [
                'attribute'=>'f_makalah',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_makalah)){
            return
            Html::a('View', ['makalah/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['makalah/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
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
