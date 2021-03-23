<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Konferensi */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Konferensi dkk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konferensi-view">

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
            'ID',
            'NIY',
            'tahun',
            'judul',
            'penyelenggara',
            'status_kehadiran',
            'nama_forum',
            'tingkat_forum',
            'lokasi',
            'tanggal_mulai',
            'tanggal_selesai',
            'link',
            [
                'attribute'=>'f_konferensi',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_konferensi)){
            return
            Html::a('View', ['konferensi/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['konferensi/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
        ],
    ]) ?>

</div>
