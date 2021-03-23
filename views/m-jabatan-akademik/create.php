<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MJabatanAkademik */

$this->title = 'Create Jabatan Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Akademik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mjabatan-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
