<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JenisLuaran */

$this->title = 'Update Jenis Luaran: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Luarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-luaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
