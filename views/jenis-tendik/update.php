<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JenisTendik */

$this->title = 'Update Jenis Tendik: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Tendiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-tendik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
