<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WewenangAjar */

$this->title = 'Create Wewenang Ajar';
$this->params['breadcrumbs'][] = ['label' => 'Wewenang Ajars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wewenang-ajar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
