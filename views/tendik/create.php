<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tendik */

$this->title = 'Create Tenaga Kependidikan';
$this->params['breadcrumbs'][] = ['label' => 'Tenaga Kependidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tendik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
