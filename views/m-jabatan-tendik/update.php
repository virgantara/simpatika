<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MJabatanTendik */

$this->title = 'Update Jabatan Tendik: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Tendik', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mjabatan-tendik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
