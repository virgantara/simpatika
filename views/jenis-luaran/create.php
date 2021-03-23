<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JenisLuaran */

$this->title = 'Create Jenis Luaran';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Luarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-luaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
