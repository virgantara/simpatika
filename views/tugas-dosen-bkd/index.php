<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TugasDosenBkdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rubrik BKD';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><?= Html::encode($this->title) ?></h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
<div class="panel-body ">

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
            [
                'attribute' => 'tugas_dosen_id',
                'value' => function($data){
                    return $data->tugasDosen->nama;
                }
            ],
            [
                'attribute' => 'unsur_id',
                'value' => function($data){
                    return $data->unsur->nama;
                }
            ],
            'nilai_minimal',
];?>    

<?php 
    foreach($unsurUtama as $q => $v)
    {
    ?>
    <h2><?=$v->urutan;?>. <?=$v->nama;?></h2>
    <table class="table" style="margin-bottom: 50px">
        <thead>
            <tr>
                
                <th>Komponen Kegiatan</th>
                <th>Sub Komponen</th>
                <th>Angka Kredit</th>
            </tr>
        </thead>
        <tbody>
         
            <?php 

                $arr = [];
                $numbering = 0;
                foreach($v->komponenKegiatans as $key => $kom)
                {
                    $label = '';
                    $label_num = '';
                    if(!in_array($kom->nama, $arr)){
                        $arr[]=$kom->nama;
                        $label = $kom->nama;
                        $numbering++;
                        $label_num = $numbering;
                    }
            ?>
            <tr>
                <td><?=$label;?></td>
                <td><?=$kom->subunsur;?></td>
                <td><?=$kom->angka_kredit;?></td>
                
            </tr>
            <?php
                } 
            
            ?>
           
        </tbody>
    </table>

    <?php
        } 
    
    ?>

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
        </div>
    </div>

</div>

