<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Jabatan */
Yii::$app->setHomeUrl(['/site/homelog']);
$this->title = 'Tambah Data Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
