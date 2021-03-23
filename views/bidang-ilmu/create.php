<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BidangIlmu */

$this->title = 'Create Bidang Ilmu';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Ilmus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-ilmu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
