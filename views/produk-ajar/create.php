<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProdukAjar */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Produk Bahan Ajar';
$this->params['breadcrumbs'][] = ['label' => 'Produk Bahan Ajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produk-ajar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
