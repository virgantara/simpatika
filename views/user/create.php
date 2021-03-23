<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <div class="panel">
    	<div class="panel-heading">
    		<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
		</div>
		<div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		        'dataDiri' => $dataDiri,
		        'listKampus' => $listKampus
		    ]) ?>
		</div>
    </div>

</div>
