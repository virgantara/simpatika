<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Penghargaan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Penghargaan';
$this->params['breadcrumbs'][] = ['label' => 'Penghargaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penghargaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
