<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Modal; 
use yii\helpers\Url; 

$this->title = 'Faculty of '.$faculty;
?>
<div class="site-faculty">
    <h1><?= Html::encode($this->title) ?></h1>

<div class="row col-lg-12">
    <hr>
<?php
    foreach($model as $D){
?>     
<div class="col-lg-4 boxprof" >
    <div class="prof">
        <div class="pull-left">
        <?php
        if(!empty($D->dosenData->f_foto)){
        ?>
        <img src='<?= Yii::$app->urlManager->baseUrl ?>/uploads/<?= $D->NIY ?>/<?= $D->dosenData->f_foto; ?>' class="fto">
          <?php  
        }else{
         ?>
        <img src='<?= Yii::$app->urlManager->baseUrl ?>/uploads/blank_foto.png' class="fto">
            <?php
        }
        ?>
        </div>
        <div class="">
        <?= $D->dosenData->nama; ?><br><?= $D->email; ?><br><?= $D->prodiDosen->nama; ?>
            <br><br><span class='pull-right'><?= Html::button('View Detail', ['value'=>Url::to('index.php?r=dosen%2Fdetail&id='.$D->ID),'class' => 'btn btn-default modalButton','id'=>'','style'=>'font-size:10px']);
            ?></span>
        </div>
    </div><br>
    </div>
<?php
    }
?>
    
</div>    
</div>

<?php
    Modal::begin([
            'header'=>'<h4>Lecturer Detail</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',

    ]);
    

        echo "<div id='modalContent'></div>";

        echo "<div id='modalContent' style='height:auto;'></div>";

    Modal::end();
    ?>