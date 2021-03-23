<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LuaranLainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Luaran Lain';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="luaran-lain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Luaran Lain', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jenis_luaran_id',
            'judul:ntext',
            'deskripsi',
            'tahun_pelaksanaan',
            //'berkas:ntext',
            //'created_at',
            'updated_at',
            //'ver',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
