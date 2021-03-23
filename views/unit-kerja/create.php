<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UnitKerja */

$this->title = 'Create Unit Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Unit Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-kerja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
