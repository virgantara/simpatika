<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Makalah */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Makalah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="makalah-view">

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
            
            'NIY',
            'judul',
            'tahun',
            'penyelenggara',
            'nama_forum',
            'kontribusi',
            'ISBN',
            'sumber_dana',
            [
                'attribute'=>'f_makalah',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_makalah)){
            return
            Html::a('View', ['makalah/display', 'id' => $data->ID],['class' => 'btn btn-warning','target'=>'_blank']).'&nbsp;&nbsp;'.
            Html::a('Download', ['makalah/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],

            'ver',
        ],
    ]) ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                
                    <h2>Author(s)</h2>
                
            </div>
            <div class="body">
                <h4>
                <ol>
                <?php 
                foreach($model->makalahAuthors as $dosen)
                {
                    echo '<li>'.$dosen->author->dataDiri->nama.'</li>';
                }
                ?>
                </ol>
            </h4>
            </div>
        </div>
    </div>
</div>
