<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Assign */

$this->title = 'Update Assignment:';
$this->params['breadcrumbs'][] = ['label' => 'Assignment', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Keterangan, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assign-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
