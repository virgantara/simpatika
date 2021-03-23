<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Resensi */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Resensi: ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Resensi dkk', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->judul, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resensi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
