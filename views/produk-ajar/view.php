<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProdukAjar */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->matkul;
$this->params['breadcrumbs'][] = ['label' => 'Produk Bahan Ajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produk-ajar-view">

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
            'matkul',
            'program_pendidikan',
            'jenis',
            'tahun_awal',
            'tahun_akhir',
//            'update_at',
            'ver',
        ],
    ]) ?>

</div>
