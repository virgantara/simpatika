<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MPangkatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mpangkats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpangkat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mpangkat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'jabatan_id',
            'nama',
            'golongan',
            'kredit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
