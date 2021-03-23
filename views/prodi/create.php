<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Prodi */

$this->title = 'Tambah Data Program Studi';
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
