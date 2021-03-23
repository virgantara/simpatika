<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Assign */

$this->title = 'Buat Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Assignment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assign-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
