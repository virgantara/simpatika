<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kegiatan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Kemahasiswaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
