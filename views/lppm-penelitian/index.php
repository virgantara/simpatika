<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LppmPenelitianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ucwords($_GET['jenis']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lppm-penelitian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create '.$this->title, ['create','jenis'=>$_GET['jenis']], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'namaSkema',
            // 'NIY',
            'judul',
            
            // 'file_proposal',
            // 'berita_acara',
             [
                'attribute' => 'ver',
                'label' => 'Status Verifikasi',
                'format' => 'raw',
                'filter'=>["1"=>"Sudah diverifikasi","0"=>"Belum diverifikasi"],
                'value'=>function($model,$url){

                    $st = $model->ver == 1 ? 'success' : 'danger';
                    $label = $model->ver == 1 ? 'Sudah diverifikasi' : 'Belum diverifikasi';
                    return '<button type="button" class="btn btn-'.$st.' btn-sm" >
                               <span>'.$label.'</span>
                            </button>';
                    
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
