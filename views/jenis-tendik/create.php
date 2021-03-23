<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JenisTendik */

$this->title = 'Create Jenis Tendik';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Tendiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-tendik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
