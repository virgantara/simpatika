<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pengajaran */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Pengajaran';
$this->params['breadcrumbs'][] = ['label' => 'Pengajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
