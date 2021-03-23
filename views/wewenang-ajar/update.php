<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WewenangAjar */

$this->title = 'Update Wewenang Ajar: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wewenang Ajars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wewenang-ajar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
