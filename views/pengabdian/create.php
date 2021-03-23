<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pengabdian */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Pengabdian';
$this->params['breadcrumbs'][] = ['label' => 'Pengabdian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengabdian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
