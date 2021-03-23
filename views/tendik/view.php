<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tendik */

$this->title = $model->NIY;
$this->params['breadcrumbs'][] = ['label' => 'Tenaga Kependidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tendik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->NIY], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->NIY], [
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
            'nama',
            'gender',
            'tempat_lahir',
            'tanggal_lahir',
            'status_kawin',
            'agama',

            'jenjang_kode',
            'perguruan_tinggi',
            'alamat_kampus:ntext',
            'telp_kampus',
            'fax_kampus',
            'alamat_rumah:ntext',
            'telp_hp',
            'unit_id',
            'jabatan_id',
        ],
    ]) ?>

</div>
