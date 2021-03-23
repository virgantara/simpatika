<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LppmPenelitian */

$this->title = 'Create '.ucwords($_GET['jenis']);
$this->params['breadcrumbs'][] = ['label' => 'Penelitian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lppm-penelitian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'jenis' => $jenis
    ]) ?>

</div>
