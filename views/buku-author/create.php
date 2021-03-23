<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BukuAuthor */

$this->title = 'Create Buku Author';
$this->params['breadcrumbs'][] = ['label' => 'Buku Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
