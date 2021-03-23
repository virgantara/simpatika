<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UnsurUtamaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unsur Utamas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unsur-utama-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Unsur Utama', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode',
            'nama',
            'urutan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
