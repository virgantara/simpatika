<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hki */

$this->title = 'Update HKI: ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'HKI', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hki-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
