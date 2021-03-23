<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status == 'Belum Diverifikasi'){
                return ['class'=>'warning'];
            }else if($model->status == 'Ditolak'){
                return ['class'=>'danger'];
            }else{
                
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
//            'assignmentData.nama',
            [
               'header' => 'Assignment',
               'value' => 'assignmentAssign.Keterangan',
               'filter' => Html::activeDropDownList($searchModel, 'id_assign',$assign,['class'=>'form-control','prompt' =>''])
            ],
//            'id_assign',
            'keterangan:ntext',
//            'status',
//            'file',
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
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => ['Belum Diverifikasi' => 'Belum Diverivikasi', 'Sudah Diverifikasi' => 'Sudah Diverifikasi','Ditolak' => 'Ditolak']
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'Action'],
        ],
    ]); ?>
</div>
