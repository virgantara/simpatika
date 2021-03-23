<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProdukAjar */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Ubah Data Produk Bahan Ajar: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Produk Bahan Ajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produk-ajar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
