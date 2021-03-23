<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Konferensi */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Konferensi dkk: ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Konferensi dkk', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->judul, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="konferensi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
