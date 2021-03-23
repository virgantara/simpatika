<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BidangKepakaran */

$this->title = 'Update Bidang Kepakaran: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Kepakarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-kepakaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
