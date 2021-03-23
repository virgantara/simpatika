<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MJabatan */

$this->title = 'Create M Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'M Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mjabatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
