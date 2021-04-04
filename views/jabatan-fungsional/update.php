<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanFungsional */

$this->title = 'Update Jabatan Fungsional: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Fungsionals', 'url' => ['index']];
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
    ]) ?>
           </div>
        </div>
    </div>
</div>
