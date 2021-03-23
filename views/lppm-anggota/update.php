<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LppmAnggota */

$this->title = 'Update Lppm Anggota: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lppm Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lppm-anggota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
