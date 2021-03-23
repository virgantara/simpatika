<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jabatan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Jabatan: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jabatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
