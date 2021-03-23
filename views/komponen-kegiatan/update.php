<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KomponenKegiatan */

$this->title = 'Update Komponen Kegiatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Komponen Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="komponen-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
