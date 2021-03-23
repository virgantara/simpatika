<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Buku */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Buku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-view">

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
            'tahun',
            'judul',
            'penerbit',
            'vol',
            'ISBN',
            'link',
            [
                'attribute'=>'f_karya',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_karya)){
            return
            Html::a('<i class="fa fa-search"></i> View', ['buku/display', 'id' => $data->ID],['class' => 'btn btn-warning','target'=>'_blank']).'&nbsp;&nbsp;'.
            Html::a('<i class="fa fa-download"></i> Download', ['buku/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
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
                foreach($model->bukuAuthors as $dosen)
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
