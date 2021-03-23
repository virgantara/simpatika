<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DataDiri */

$this->title = 'Update Data Diri: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Data Diri', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-diri-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
