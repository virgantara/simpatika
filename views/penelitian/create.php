<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Penelitian */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Penelitian';
$this->params['breadcrumbs'][] = ['label' => 'Penelitian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penelitian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
