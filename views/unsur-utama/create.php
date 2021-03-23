<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UnsurUtama */

$this->title = 'Create Unsur Utama';
$this->params['breadcrumbs'][] = ['label' => 'Unsur Utamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unsur-utama-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
