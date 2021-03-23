<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Kegiatan Kemahasiswaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
            [
                'attribute' => 'nama_kegiatan',
                'contentOptions' => ['style' => 'width:30%;  white-space: normal;'],
            ],
            'peran',
            'tempat',
            'tahun_awal',
            'tahun_akhir',
            // 'update_at',
            [
                'attribute' => 'ver',
                'format' => 'raw',
                'filter' => ['Belum Diverifikasi' => 'Belum Diverivikasi', 'Sudah Diverifikasi' => 'Sudah Diverifikasi','Ditolak' => 'Ditolak']
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'Action'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
