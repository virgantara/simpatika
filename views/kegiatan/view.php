<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kegiatan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->nama_kegiatan;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Kemahasiswaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-view">

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
            'nama_kegiatan',
            'peran',
            'tempat',
            'tahun_awal',
            'tahun_akhir',
            'update_at',
            'ver',
        ],
    ]) ?>

</div>
