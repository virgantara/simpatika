<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Makalah */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Makalah';
$this->params['breadcrumbs'][] = ['label' => 'Makalah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="makalah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
