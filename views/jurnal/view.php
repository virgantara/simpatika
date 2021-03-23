<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jurnal */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Jurnals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?= Html::encode($this->title) ?>
                </h2>
            </div>

        <div class="form-group">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>


    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'namaJenisLuaran',
            'judul:ntext',
            'nama_jurnal',
            'pissn',
            'eissn',
            'volume',
            'nomor',
            'halaman',
            'tahun_terbit',
            [
                'label' => 'Shared Link Berkas',
                'format'=> 'raw',
                'value' => function($data){
                    return Html::a('Lihat Berkas',$data->berkas,['target'=>'_blank']);
                },
            ],
             [
                'attribute'=>'path_berkas',
                'format'=>'raw',
                'value' => function($data){
                    if(!empty($data->path_berkas)){
                    return
                    Html::a('<i class="fa fa-search"></i> View', ['jurnal/display', 'id' => $data->id],['class' => 'btn btn-warning','target'=>'_blank']).'&nbsp;&nbsp;'.
                    Html::a('<i class="fa fa-download"></i> Download', ['jurnal/download', 'id' => $data->id],['class' => 'btn btn-primary']);
                    }
                    else
                    {
                    return
                    "<p class='btn btn-danger' align='center'>No File</p>";
                    }
                    }
                    ],
            'sumber_dana',
            [
                'label' => 'Status Verifikasi',
                'format'=> 'raw',
                'value' => function($data){
                    return $data->is_approved == 2 ? '<label class="label label-danger">Menunggu Verifikasi LPPM UNIDA Gontor</' : '<label class="label label-success">Sudah Diverifikasi</label>';
                },
            ],
        ],
    ]) ?>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                
                    <h2>Author(s)</h2>
                
            </div>
            <div class="body">
                <h4>
                <ol>
                <?php 
                foreach($model->jurnalAuthors as $dosen)
                {
                    echo '<li>'.$dosen->author->dataDiri->nama.'</li>';
                }
                ?>
                </ol>
            </h4>
            </div>
        </div>
    </div>
</div>