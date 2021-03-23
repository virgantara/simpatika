<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Fakultas */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Fakultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fakultas-view">

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
            'nama',
        ],
    ]) ?>
    <br><br>
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getProdiFakultas()]),
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'nama',
//            'id_fak',
            'jumlahDosen',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['prodi/'.$action, 'id' => $model->ID]);
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
