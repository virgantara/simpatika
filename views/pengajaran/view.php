<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pengajaran */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Pengajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajaran-view">

    

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
            'NIY',
            'kode_mk',
            'matkul:ntext',
            'kelas',
            'sks',

            'jurusan',
            'tahun_akademik',
             [
                'attribute'=>'f_penugasan',
                'format'=>'raw',
                'value' => function($data){
                    if(!empty($data->f_penugasan)){
                        return Html::a('View', $data->f_penugasan,['class' => 'btn btn-warning','data-pjax' => 0,'target'=>'_blank']);
                    }

                    else
                    {
                        return "<p class='btn btn-danger' align='center'>No File</p>";
                    }
                }
            ],
            'ver',
        ],
    ]) ?>

</div>
