<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Makalah */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Makalah / Poster: ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Makalah / Poster', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->judul, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="makalah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
