<?php
use yii\helpers\Html;
use yii\grid\GridView;
$size = 0;
?>


<br>
<?php
foreach($contact as $C){
    $size=$size+50;
    ?>
<a href='index.php?r=support/index&send=<?= $C->NIY ?>'>
        <div class="col-lg-12" style="border-top:solid;border-width:1px; padding:3px 0px 5px 0px;">
            <h5><b><?= $C->NIY.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$C->dosenData->nama
        ."<span class='pull-right'>"
        //.$C->prodiDosen->nama
        ."</span>"; ?></b></h5>
        </div>
</a>

<?php
    
}
?>
<div class="" style="height:<?= $size; ?>px">
</div>