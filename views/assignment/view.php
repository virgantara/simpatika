<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Assignment */

$this->title = $model->assignmentAssign->Keterangan;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-view">

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
            'assignmentAssign.Keterangan',
            'keterangan:ntext',
            [
                'attribute'=>'file',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->file)){
            return
            Html::a('View', ['assignment/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['assignment/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'status',
//            [
//                'header'=>'file',
//                'format'=>'raw',
//                'value' => function($data){
//            return
//            Html::a('View', ['assignment/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
//            Html::a('Download', ['assignment/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
//            }
//            ],
//            'file',
        ],
    ]) ?>

</div>
