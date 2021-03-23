<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KomponenKegiatan */

$this->title = 'Create Komponen Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Komponen Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komponen-kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
