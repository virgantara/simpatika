<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PenelitianAnggota */

$this->title = 'Update Penelitian Anggota: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penelitian Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penelitian-anggota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
