<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrganisasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Organisasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisasi-index">

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
            'organisasi',
             'jabatan',
            'tahun_awal',
            'tahun_akhir',
//             'f_sk',
            // 'update_at',
            [
                'attribute'=>'f_sk',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_sk)){
            return
            Html::a('View', ['organisasi/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['organisasi/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
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
