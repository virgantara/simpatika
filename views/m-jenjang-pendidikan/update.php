<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MJenjangPendidikan */

$this->title = 'Update Jenjang Pendidikan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jenjang Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mjenjang-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
