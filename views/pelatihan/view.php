<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pelatihan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->nama_pelatihan;
$this->params['breadcrumbs'][] = ['label' => 'Pelatihan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelatihan-view">

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
            'nama_pelatihan',
            'penyelenggara',
            'tanggal_awal',
            'tanggal_akhir',
            [
                'attribute'=>'f_sertifikat',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_sertifikat)){
            return
            Html::a('View', ['pelatihan/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['pelatihan/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
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
