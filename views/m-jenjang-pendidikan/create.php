<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MJenjangPendidikan */

$this->title = 'Create Jenjang Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Jenjang Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mjenjang-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
