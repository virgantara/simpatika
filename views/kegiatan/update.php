<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kegiatan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Kegiatan: ' . $model->nama_kegiatan;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Kemahasiswaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_kegiatan, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
