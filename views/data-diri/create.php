<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DataDiri */

Yii::$app->setHomeUrl(['/site/homelog']);

$this->title = 'Biodata Diri';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-diri-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listBidangIlmu' => $listBidangIlmu,
        'listKepakaran' => $listKepakaran,
        'listKampus' => $listKampus
    ]) ?>

</div>
