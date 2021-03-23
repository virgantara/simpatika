<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Organisasi */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Organisasi: ' . $model->organisasi;
$this->params['breadcrumbs'][] = ['label' => 'Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->organisasi, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="organisasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
