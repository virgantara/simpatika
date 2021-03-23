<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use common\models\Prodi;
use common\models\Penelitian;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'UNIDA Gontor Lecturer Data';
?>
    <div class="site-index">

        <div class="body-content">
            
            <div class="row" id='lecturer'>
                <?php
            
                foreach($model as $values){ 
                $nilai[]= array('type'=> 'column', 'name' =>$values->aliasi, 'data' => array((int)$values->jumlahDosen)); 
}
                
            echo Highcharts::widget([
                        'options' => [
                        'title' => ['text' => 'Lecturers University of Darussalam Gontor'],
                        'xAxis' => [
                            'categories' => [
                                                'Department'
                                            ]
//                                            foreach($model as $prod){
//                                                echo $prod->nama;
//                                            }
                                            ],
                        'yAxis' => [
                            'title' => ['text' => 'Total of Lecturer']
                                            ],
                            'series' => $nilai
                                        ]
                                        ]);
            
            ?>
            <br>
            <br>
            </div>
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">DOSEN TETAP INSTITUSI</h3>
        <p class="panel-subtitle">Date day : <?=date('d M Y');?></p>
    </div>
    <div class="panel-body">
            <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <td rowspan="2" style="text-align: center; vertical-align: middle;">No</td>
                            <td rowspan="2" style="text-align: center; vertical-align: middle;">Pendidikan</td>
                            <td colspan="5" style="text-align: center; vertical-align: middle;">Gelar Akademik</td>
                            <td rowspan="2" style="text-align: center; vertical-align: middle;">Total</td>
                        </tr>
                        <tr>
                            <td>Guru Besar</td>
                            <td>Lektor Kepala</td>
                            <td>Lektor</td>
                            <td>Asisten Ahli</td>
                            <td>Tenaga Pengajar</td>
                        </tr>
                        <tr>
                            <td>(1)</td>
                            <td>(2)</td>
                            <td>(3)</td>
                            <td>(4)</td>
                            <td>(5)</td>
                            <td>(6)</td>
                            <td>(7)</td>
                            <td>(8)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_all = 0;
                        foreach($dataTable as $qq => $vv){
                            // print_r($vv);
                            foreach ($vv as $key => $value) {
                                $total_all += $value;
                            }
                        }
                        ?>
                        <tr>
                            <td>1</td>
                            <td>S-3 / Sp-2</td>
                            <td>
                    <?= Html::a($dataTable['gb']['s3'], ['/data-diri/list','jenjang'=>'S3','pangkat'=>'GB']) ?>
                            </td>
                            <td>
                             <?= Html::a($dataTable['lk']['s3'], ['/data-diri/list','jenjang'=>'S3','pangkat'=>'LK']) ?>    
                          </td>
                            <td>
                     <?= Html::a($dataTable['l']['s3'], ['/data-diri/list','jenjang'=>'S3','pangkat'=>'L']) ?>
                               </td>
                            <td>
                     <?= Html::a($dataTable['aa']['s3'], ['/data-diri/list','jenjang'=>'S3','pangkat'=>'AA']) ?>
                            </td>
                            <td>
                     <?= Html::a($dataTable['tt']['s3'], ['/data-diri/list','jenjang'=>'S3','pangkat'=>'TT']) ?>
                  </td>
                            <td><?=$dataTable['gb']['s3']+$dataTable['lk']['s3']+$dataTable['l']['s3']+$dataTable['aa']['s3']+$dataTable['tt']['s3']?></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>S-2 / Sp-1</td>
                            <td>
                    <?= Html::a($dataTable['gb']['s2'], ['/data-diri/list','jenjang'=>'S2','pangkat'=>'GB']) ?>
                            </td>
                            <td>
                             <?= Html::a($dataTable['lk']['s2'], ['/data-diri/list','jenjang'=>'S2','pangkat'=>'LK']) ?>    
                          </td>
                            <td>
                     <?= Html::a($dataTable['l']['s2'], ['/data-diri/list','jenjang'=>'S2','pangkat'=>'L']) ?>
                               </td>
                            <td>
                     <?= Html::a($dataTable['aa']['s2'], ['/data-diri/list','jenjang'=>'S2','pangkat'=>'AA']) ?>
                            </td>
                            <td>
                     <?= Html::a($dataTable['tt']['s2'], ['/data-diri/list','jenjang'=>'S2','pangkat'=>'TT']) ?>
                 
                            </td>
                              <td><?=$dataTable['gb']['s2']+$dataTable['lk']['s2']+$dataTable['l']['s2']+$dataTable['aa']['s2']+$dataTable['tt']['s2']?></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Profesi / S-1 / D-IV</td>
                             <td>
                    <?= Html::a($dataTable['gb']['s1'], ['/data-diri/list','jenjang'=>'S1','pangkat'=>'GB']) ?>
                            </td>
                            <td>
                             <?= Html::a($dataTable['lk']['s1'], ['/data-diri/list','jenjang'=>'S1','pangkat'=>'LK']) ?>    
                          </td>
                            <td>
                     <?= Html::a($dataTable['l']['s1'], ['/data-diri/list','jenjang'=>'S1','pangkat'=>'L']) ?>
                               </td>
                            <td>
                     <?= Html::a($dataTable['aa']['s1'], ['/data-diri/list','jenjang'=>'S1','pangkat'=>'AA']) ?>
                            </td>
                            <td>
                     <?= Html::a($dataTable['tt']['s1'], ['/data-diri/list','jenjang'=>'S1','pangkat'=>'TT']) ?>
                 
                            </td>
                              <td><?=$dataTable['gb']['s1']+$dataTable['lk']['s1']+$dataTable['l']['s1']+$dataTable['aa']['s1']+$dataTable['tt']['s1']?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td><?=$dataTable['gb']['s3']+$dataTable['gb']['s2']+$dataTable['gb']['s1'];?></td>
                            <td><?=$dataTable['lk']['s3']+$dataTable['lk']['s2']+$dataTable['lk']['s1'];?></td>
                            <td><?=$dataTable['l']['s3']+$dataTable['l']['s2']+$dataTable['l']['s1'];?></td>
                            <td><?=$dataTable['aa']['s3']+$dataTable['aa']['s2']+$dataTable['aa']['s1'];?></td>
                            <td><?=$dataTable['tt']['s3']+$dataTable['tt']['s2']+$dataTable['tt']['s1'];?></td>
                            <td><?=$total_all;?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>   
        </div>
    </div>
</div>
            <div class="row" id='research'>
            
                <h1>Research This Year:</h1><br>
            <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'penelitianData.dataDosen.prodiDosen.nama',
//            'NIY',
            [
                'attribute' => 'judul',
                'contentOptions' => ['style' => 'width:30%;  white-space: normal;'],
            ],
            [
                'header'=>'Oleh',
                'value'=>'penelitianData.nama',
            ],
            'tahun',
//            'status',
            'sumberdana',
//            'f_penelitian',
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

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?><br><br><br>
            </div>

            <div class="row" id='dedication'>
            <h1>Dedication This Year:</h1><br>
            <?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            'pengabdianData.dataDosen.prodiDosen.nama',
            [
                'attribute' => 'nama_kegiatan',
                'contentOptions' => ['style' => 'width:30%;  white-space: normal;'],
            ],
            [
                'header'=>'Oleh',
                'value'=>'pengabdianData.nama',
            ],
            'tahun',
            'tempat',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
            <br><br><br>
            </div>
            
            <div class="row" id='appreciation'>
            <h1>Appreciation This Year:</h1><br>
            <?= GridView::widget([
        'dataProvider' => $dataProvider3,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'penghargaanData.dataDosen.prodiDosen.nama',
            'NIY',
            'penghargaanData.nama',
            'tahun',
            'bentuk',
            'pemberi',
//            'f_penghargaan',
        ],
    ]); ?>
            <br><br><br>
            </div>
            
        </div>
    </div>