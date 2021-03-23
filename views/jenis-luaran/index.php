<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JenisLuaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Luarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-luaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jenis Luaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'kode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
