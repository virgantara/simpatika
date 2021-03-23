<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LuaranLain */

$this->title = 'Update Luaran Lain: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Luaran Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="luaran-lain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
