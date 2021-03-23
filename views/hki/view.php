<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Hki */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'HKI', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hki-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'jenisHki.nama',
            'no_pendaftaran',
            'judul',
            'status_hki',
            'tahun_pelaksanaan',
            'sumber_dana',
            [
                'attribute'=>'berkas',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->berkas)){
            return
            Html::a('<i class="fa fa-search"></i> View', ['hki/display', 'id' => $data->id],['class' => 'btn btn-warning','target'=>'_blank']).'&nbsp;&nbsp;'.
            Html::a('<i class="fa fa-download"></i> Download', ['hki/download', 'id' => $data->id],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver'
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
                foreach($model->hkiAuthors as $dosen)
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
