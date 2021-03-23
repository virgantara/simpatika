<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pelatihan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Pelatihan: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Pelatihan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pelatihan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
