<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LuaranLain */

$this->title = 'Create Luaran Lain';
$this->params['breadcrumbs'][] = ['label' => 'Luaran Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="luaran-lain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
