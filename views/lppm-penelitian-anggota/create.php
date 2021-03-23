<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LppmPenelitianAnggota */

$this->title = 'Add Anggota';
$this->params['breadcrumbs'][] = ['label' => 'Penelitian Anggota', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lppm-penelitian-anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
