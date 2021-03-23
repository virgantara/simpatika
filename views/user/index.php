<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Prodi;
//use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
    $gridColumns = [
    [
        'class'=>'kartik\grid\SerialColumn',
        'contentOptions'=>['class'=>'kartik-sheet-style'],
        'width'=>'36px',
        'pageSummary'=>'Total',
        'pageSummaryOptions' => ['colspan' => 6],
        'header'=>'',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
        
        'NIY',
            [
               'attribute' => 'nama',
               'value' => function($data){
                    return !empty($data->dataDiri) ? $data->dataDiri->nama : '';
               }
               
            ],
            'email:email',
            [
               'attribute' => 'id_prod',
               'value' => 'prodiUser.nama',
               'filter' => Html::activeDropDownList($searchModel, 'id_prod',$prodi,['class'=>'form-control','prompt' =>''])
            ],
            [
                'attribute' => 'status_admin',
                'format' => 'raw',
                'filter' => ['admin' => 'Admin', 'user' => 'User']
            ],
//            'auth_key',
//            'password_hash',
            // 'password_reset_token',
//            'status',
            'uuid',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => 'status',
                'filter' => ['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif']
            ],
            
    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view} {update} {delete}',
        // 'visibleButtons' => [
        //     'delete' => function ($model, $key, $index) {
        //         return Yii::$app->user->can('baak');
        //     },
        //     'update' => function ($model, $key, $index) {
        //         return Yii::$app->user->can('baak');
        //     },
        // ]
        
    ]
];?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'], 
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'containerOptions' => ['style'=>'overflow: auto'], 
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=> $this->title, 'options'=>['colspan'=>14, 'class'=>'text-center warning']], //cuma satu 
                ], 
                'options'=>['class'=>'skip-export'] 
            ]
        ],
        'exportConfig' => [
              GridView::PDF => ['label' => 'Save as PDF'],
              GridView::EXCEL => ['label' => 'Save as EXCEL'], //untuk menghidupkan button export ke Excell
              GridView::HTML => ['label' => 'Save as HTML'], //untuk menghidupkan button export ke HTML
              GridView::CSV => ['label' => 'Save as CSV'], //untuk menghidupkan button export ke CVS
          ],
          
        'toolbar' =>  [
            '{export}', 

           '{toggleData}' //uncoment untuk menghidupkan button menampilkan semua data..
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        // 'condensed' => false,
        // 'responsive' => false,
        'hover' => true,
        // 'floatHeader' => true,
        // 'showPageSummary' => true, //true untuk menjumlahkan nilai di suatu kolom, kebetulan pada contoh tidak ada angka.
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>   
</div>
