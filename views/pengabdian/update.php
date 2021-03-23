<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pengabdian */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Pengabdian: ' . $model->nama_kegiatan;
$this->params['breadcrumbs'][] = ['label' => 'Pengabdian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_kegiatan, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengabdian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
