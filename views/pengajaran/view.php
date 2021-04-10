<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pengajaran */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Pengajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-md-6">
        
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Data Pengajaran</h3>
            </div>
            <div class="panel-body">
                <p>
                    <?= Html::a('<i class="fa fa-upload"></i> Upload Bukti', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'NIY',
                            'kode_mk',
                            'matkul:ntext',
                            'kelas',
                            'sks',

                            'jurusan',
                            'tahun_akademik',
                             
                        ],
                    ]) ?>
            </div>
        </div>

    
    </div>
    <div class="col-md-6">
        
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Data Bukti Pengajaran</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis File</th>
                                <th>Tipe File</th>
                                <th>Tautan</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($bukti_pengajaran as $q => $bukti)
                            {
                            ?>
                            <tr>
                                <td><?=$q+1;?></td>
                                <td><?=$bukti->nama_jenis_dokumen;?></td>
                                <td><?=$bukti->jenis_file;?></td>
                                <td><?=Html::a('<i class="fa fa-share"></i> Tautan',$bukti->tautan,['target'=>'_blank','class'=>'btn btn-primary']);?></td>

                           
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>    
                </div>
                
            </div>
        </div>
    </div>
</div>
