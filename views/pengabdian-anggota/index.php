<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PengabdianAnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengabdian Anggotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengabdian-anggota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengabdian Anggota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'NIY',
            'status_anggota',
            'pengabdian_id',
            'created',
            //'beban_kerja',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
