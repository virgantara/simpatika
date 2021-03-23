<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pelatihan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Pelatihan';
$this->params['breadcrumbs'][] = ['label' => 'Pelatihan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelatihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
