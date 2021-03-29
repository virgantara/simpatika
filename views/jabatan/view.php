<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Jabatan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->jabatan->nama.' '.$model->unker->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute'=>'nama',
                'value'=>function($data){
                    return $data->nIY->dataDiri->nama;
                }
            ],
          
            [
                'attribute'=>'jabatan_id',
                'value'=>function($data){
                    return $data->jabatan->nama;
                }
                
            ],
             [
                'attribute'=>'unker_id',
                'value'=>function($data){
                    return $data->unker->nama;
                }
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
        ],
    ]) ?>

</div>
