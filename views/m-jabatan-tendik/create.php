<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MJabatanTendik */

$this->title = 'Create Jabatan Tendik';
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Tendik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mjabatan-tendik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
