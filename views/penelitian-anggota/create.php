<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PenelitianAnggota */

$this->title = 'Create Penelitian Anggota';
$this->params['breadcrumbs'][] = ['label' => 'Penelitian Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penelitian-anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
