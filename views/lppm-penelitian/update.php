<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LppmPenelitian */

$this->title = 'Update Penelitian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penelitian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lppm-penelitian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'jenis' => $jenis
    ]) ?>

</div>
