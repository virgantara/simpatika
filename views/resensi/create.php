<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Resensi */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Resensi dkk';
$this->params['breadcrumbs'][] = ['label' => 'Resensi dkk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resensi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
