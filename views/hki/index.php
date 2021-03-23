<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HkiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hak Kekayaan Intelektual (HKI)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hki-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create HKI', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jenis_hki_id',
            'no_pendaftaran',
            'judul',
            'status_hki',
            'tahun_pelaksanaan',
            'sumber_dana',
            //'berkas:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
