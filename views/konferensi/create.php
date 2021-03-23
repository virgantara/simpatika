<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Konferensi */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Konferensi dkk';
$this->params['breadcrumbs'][] = ['label' => 'Konferensi dkk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konferensi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
