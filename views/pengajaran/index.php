<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
$this->title = 'Riwayat Pengajaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
         // Html::dropDownList('tahun','', [], ['id' => 'tahun_list','prompt'=>'- Pilih Tahun -']) ;
         ?>
    </p>
    <div class="pengajaran-index">
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
        
        
        // [
        //     'attribute'=>'namanya',
        //     'value'=>'pengajaranData.nama',
        // ],
        // 'NIY',
        'kode_mk',
        'matkul',
        'jurusan',
        'sks',
        'kelas',
        'tahun_akademik',
//            'f_penugasan',
        [
            'attribute'=>'bukti',
            'format'=>'raw',
            'value' => function($data){
                if(!empty($data->f_penugasan)){
                    return Html::a('View', $data->f_penugasan,['class' => 'btn btn-warning','data-pjax' => 0,'target'=>'_blank']);
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
        'template' => '{view} {update}',
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

</div>


<?php 

$this->registerJs(' 



$(document).on("change","#tahun_list",function(e){
    e.preventDefault()

    var obj = new Object
    obj.tahun = $(this).val()

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['pengajaran/ajax-jadwal']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            var row = ""
            $("#tabel-pengajaran > tbody").empty()
            var total_sks = 0
            $.each(res, function(i,obj){
                row += "<tr>"
                row += "<td>"+(i+1)+"</td>"
                row += "<td>"+obj.kode_mk+"</td>"
                row += "<td>"+obj.nama_mk+"</td>"
                row += "<td>"+obj.sks+"</td>"
                row += "<td>"+obj.kelas+"</td>"
                row += "<td>"+obj.prodi+"</td>"
                row += "<td>"+obj.ta+"</td>"
                row += "</tr>"

                total_sks += eval(obj.sks)
            })

            $("#tabel-pengajaran > tbody").append(row)
                
        }

    });

})

getTahunList(function(err, res){
    $("#tahun_list").empty()
    var row = ""
    $.each(res, function(i, obj){
        row += "<option value=\'"+obj.tahun_id+"\'>"+obj.nama_tahun+"</option>"
    })

    $("#tahun_list").append(row)


    $("#tahun_list").trigger("change")
})

function getTahunList(callback){
    $.ajax({
        type : \'POST\',
        
        url : \''.Url::to(['site/ajax-tahun-list']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            callback(null, res)
        }

    });
}

', \yii\web\View::POS_READY);

?>