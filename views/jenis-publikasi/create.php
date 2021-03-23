<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JenisPublikasi */

$this->title = 'Create Jenis Publikasi';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Publikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-publikasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
