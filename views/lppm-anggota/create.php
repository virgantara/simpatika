<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LppmAnggota */

$this->title = 'Create Lppm Anggota';
$this->params['breadcrumbs'][] = ['label' => 'Lppm Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lppm-anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
