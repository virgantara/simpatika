<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SupportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Support System';
?>
<div class="support-index">
<div class="col-lg-12"><br>
  <?php
    foreach($data as $D){
        if($D->sender == Yii::$app->user->identity->NIY){
            ?>
        <div class="col-lg-12">
        <div class="pull-right balloon" style="background-color:lightgreen; margin-left:550px;border-radius:20px 20px 0px 20px;">
        <?= "<h5 style='width:200px;'><b><u>You</u></b></h5><p align='justify'>".$D->pesan."</p>"."<span class='pull-right' style='font-size:10px;'>".$D->waktu."</span>"; ?>
        </div>
        </div>
            <?php
        }else{
            ?>
        <div class="col-lg-12">
        <div class="pull-left balloon" style="background-color:lightskyblue;margin-right:550px;border-radius:20px 20px 20px 0px;">
        <?= "<h5 style='width:200px;'><b><u>Admin</u></b></h5><p align='justify'>".$D->pesan."</p>"."<span class='pull-right' style='font-size:10px;'>".$D->waktu."</span>"; ?>
        </div>
        </div>
    <?php
        }
    }
    ?>

</div>
</div>
<div class="pesan">
<?php $form = ActiveForm::begin(); ?>
    <span class="pull-left">
<?= $form->field($model, 'pesan')->textarea(['rows' => 1,'class'=>'areapesan']) ?>
    </span>
    <span class="pull-right">
<?= Html::submitButton('Kirim', ['class' => 'btn btn-default buttonpesan']) ?>
    </span>
<?php $form = ActiveForm::end(); ?>
</div>

