<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BidangIlmu */

$this->title = 'Update Bidang Ilmu: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Ilmus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-ilmu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
