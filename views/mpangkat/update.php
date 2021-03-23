<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MPangkat */

$this->title = 'Update Mpangkat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mpangkats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpangkat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
