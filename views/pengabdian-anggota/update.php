<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PengabdianAnggota */

$this->title = 'Update Pengabdian Anggota: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengabdian Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengabdian-anggota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
