<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CatatanHarian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Catatan Harians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

            <div class="panel-body ">
        
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'unsur_id',
                'value' => function($data){
                    return $data->unsur->nama;
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user->dataDiri->nama;
                }
            ],
            'deskripsi:html',
            'tanggal',
            'is_selesai',
            'approved_by',
            'updated_at',
            'created_at',
        ],
    ]) ?>

            </div>
        </div>

    </div>
</div>