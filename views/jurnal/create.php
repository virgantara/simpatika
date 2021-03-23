<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jurnal */

$this->title = 'Create Jurnal';
$this->params['breadcrumbs'][] = ['label' => 'Jurnals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
