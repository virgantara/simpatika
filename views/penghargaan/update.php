<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Penghargaan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Update Penghargaan: ' . $model->bentuk;
$this->params['breadcrumbs'][] = ['label' => 'Penghargaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bentuk, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penghargaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
