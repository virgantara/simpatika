<style>
    .row-me{
        border-bottom:solid; height:30px;margin-top:10px;border-width:1px; border-color:#54a0ff;
    }
</style>

<div class="container dosen-detail" style="height:600px;">

<div class="container dosen-detail">

<div class="content row col-lg-8 bardetail">
    
    <div class="col-lg-4">
        <?php
        if(!empty($model->dosenData->f_foto)){
        ?>
        <img src='<?= Yii::$app->urlManager->baseUrl ?>/uploads/<?= $model->NIY ?>/<?= $model->dosenData->f_foto; ?>' class="ftodetail"> <br><br>
          <?php  
        }else{
         ?>
        <img src='<?= Yii::$app->urlManager->baseUrl ?>/uploads/blank_foto.png' class="ftodetail"> <br><br>
            <?php
        }
        ?>
    </div>
    <div class="col-lg-8" >
        <div class="row ">

            <div class="col-xs-4 row-me"><b>NIY</b></div>
            <div class="col-xs-1 row-me">:</div>
            <div class="col-xs-7 row-me"><?=$model->NIY;?></div>
        </div>
        <div class="row ">

            <div class="col-xs-4 row-me"><b>Nama</b></div>
            <div class="col-xs-1 row-me">:</div>
            <div class="col-xs-7 row-me"><?=$model->dosenData->nama;?></div>
        </div>
        <div class="row ">

            <div class="col-xs-4 row-me"><b>Program Studi</b></div>
            <div class="col-xs-1 row-me">:</div>
            <div class="col-xs-7 row-me"><?=$model->prodiDosen->nama;?></div>
        </div>
         <div class="row ">

             <div class="col-xs-4 row-me"><b>Jenis Kelamin</b></div>
            <div class="col-xs-1 row-me">:</div>
            <div class="col-xs-7 row-me"><?=$model->dosenData->gender;?></div>
        </div>
         <div class="row ">

             <div class="col-xs-4 row-me"><b>Email</b></div>
            <div class="col-xs-1 row-me">:</div>
            <div class="col-xs-7 row-me"><?=$model->email;?></div>
        </div>
         <div class="row ">

             <div class="col-xs-4 row-me"><b>Telp/Hp</b></div>
            <div class="col-xs-1 row-me">:</div>
            <div class="col-xs-7 row-me"><?=$model->dosenData->telp_hp;?></div>
        </div>
         <div class="row ">

             <div class="col-xs-4 " style="margin-top:10px;"><b>Alamat Rumah</b></div>
            <div class="col-xs-1 " style="margin-top:10px;">:</div>
            <div class="col-xs-7 row-me"><?=$model->dosenData->alamat_rumah;?></div>

        </div>
  
    </div>
</div>
</div>