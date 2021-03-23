<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LppmSkemaPenelitian */

$this->title = 'Update Lppm Skema Penelitian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lppm Skema Penelitians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lppm-skema-penelitian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
