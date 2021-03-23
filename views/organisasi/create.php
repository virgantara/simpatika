<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Organisasi */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Organisasi';
$this->params['breadcrumbs'][] = ['label' => 'Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
