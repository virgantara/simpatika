<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BidangKepakaran */

$this->title = 'Create Bidang Kepakaran';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Kepakarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-kepakaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
