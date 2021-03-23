<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LppmSkemaPenelitian */

$this->title = 'Create Lppm Skema Penelitian';
$this->params['breadcrumbs'][] = ['label' => 'Lppm Skema Penelitians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lppm-skema-penelitian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
