<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JabatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jabatan Dalam Institusi';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-index">

<p>
    <?=Html::a('<i class="fa fa-plus"></i> Tambah',['jabatan/create'],['class'=>'btn btn-primary']);?>
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
                'attribute'=>'nama',
                'value'=>'nIY.dataDiri.nama',
            ],
          
            [
                'attribute'=>'jabatan_id',
                'value'=>'jabatan.nama',
            ],
             [
                'attribute'=>'unker_id',
                'value'=>'unker.nama',
            ],
            'tanggal_awal',
            'tanggal_akhir',
//            'f_penugasan',
            // 'update_at',
            [
                'attribute'=>'f_penugasan',
                'format'=>'raw',
                'value' => function($data){
                    if(!empty($data->f_penugasan)){
                        return Html::a('View', ['jabatan/display', 'id' => $data->ID],[
                        'class' => 'btn btn-warning','target'=>'_blank','data-pjax' => 0]);
                    }
                    else
                    {
                        return "<p class='btn btn-danger' align='center'>No File</p>";
                    }
                }
            ],
            [
                'attribute' => 'ver',
                'format' => 'raw',
                'filter' => ['Belum Diverifikasi' => 'Belum Diverivikasi', 'Sudah Diverifikasi' => 'Sudah Diverifikasi','Ditolak' => 'Ditolak']
            ],
    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view} {update} {delete}',

        
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
