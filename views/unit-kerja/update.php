<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UnitKerja */

$this->title = 'Update Unit Kerja: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unit Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-kerja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
