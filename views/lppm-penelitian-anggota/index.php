<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LppmPenelitianAnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lppm Penelitian Anggotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lppm-penelitian-anggota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anggota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'NIY',
            'anggota_id',
            'beban_kerja',
            'lppm_penelitian_id',
            //'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
