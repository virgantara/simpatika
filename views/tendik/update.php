<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tendik */

$this->title = 'Update Tenaga Kependidikan: ' . $model->NIY;
$this->params['breadcrumbs'][] = ['label' => 'Tenaga Kependidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NIY, 'url' => ['view', 'id' => $model->NIY]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tendik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
