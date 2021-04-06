<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenunjangLain */

$this->title = 'Update Penunjang Lain: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penunjang Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h3><?= Html::encode($this->title) ?></h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body ">
                <?= $this->render('_form', [
                    'model' => $model,
                    'list_jenis' => $list_jenis,
                ]) ?>
           </div>
        </div>
    </div>
</div>
