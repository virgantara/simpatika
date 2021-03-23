<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BukuAuthor */

$this->title = 'Update Buku Author: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Buku Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="buku-author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
