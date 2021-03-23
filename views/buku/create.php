<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Buku */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Buku';
$this->params['breadcrumbs'][] = ['label' => 'Buku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
