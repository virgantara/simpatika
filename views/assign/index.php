<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal; 
use yii\helpers\Url; 

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AssignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assign-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    Modal::begin([
            'header'=>'<h4>Submit Assignment</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
    ]);
    
        echo "<div id='modalContent'></div>";
    Modal::end();
    ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'Keterangan',
            [
                'header'=>'Submission',
                'format'=>'raw',
                'value' => function($data){
            return
            Html::button('Submit', ['value'=>Url::to('index.php?r=assignment/create&id_ass='.$data->ID),'class' => 'btn btn-success modalButton','id'=>'']);
            }
            ],
//            'status',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
