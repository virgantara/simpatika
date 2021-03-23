<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DataDiri */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Data Diri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-diri-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
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
            'NIDN',
            'NIY',
            'nama',
            'gender',
            'tempat_lahir',
            'tanggal_lahir',
            'status_kawin',
            'agama',
            'pangkat',
            'jabatan_fungsional',
            'perguruan_tinggi',
            'alamat_kampus:ntext',
            'telp_kampus',
            'fax_kampus',
            'alamat_rumah:ntext',
            'telp_hp',
            'f_foto',
        ],
    ]) ?>

</div>
