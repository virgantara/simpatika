<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pengajaran */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Upload Bukti Pengajaran: ['.$model->kode_mk.'] '.$model->matkul.' TA: '.$model->tahun_akademik;
$this->params['breadcrumbs'][] = ['label' => 'Pengajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengajaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fileBukti' => $fileBukti,
    ]) ?>

</div>
