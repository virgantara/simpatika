<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hki */

$this->title = 'Create HKI';
$this->params['breadcrumbs'][] = ['label' => 'HKI', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hki-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
