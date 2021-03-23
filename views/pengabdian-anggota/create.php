<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PengabdianAnggota */

$this->title = 'Create Pengabdian Anggota';
$this->params['breadcrumbs'][] = ['label' => 'Pengabdian Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengabdian-anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
