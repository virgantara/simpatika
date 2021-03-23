<?php
use yii\helpers\Html;
use common\models\DataDiri;
/* @var $this yii\web\View */

$this->title = 'Lecturer Data UNIDA Gontor';
?>
<div class="site-index">

    <div class="col-lg-12 jumbotron" >
        <div class="col-lg-10 uptown">
            <div class="col-lg-5">
                <?php
                if(!empty($model->f_foto)){
                    echo "<img src='".$model->f_foto."' class='img-rounded pull-right' style='height:240px;'>";
                }else{
                    echo "<img src='".Yii::$app->view->theme->baseUrl."/assets/img/1.png'"."class='img-rounded pull-right' style='height:240px;'>";
                }
                ?>
            
            </div>        
            <div class="col-lg-7 " align="left" style="padding-left:30px;">
                
            <table>
            <tr>
                <td><h3><b>NIY</b></h3></td><td><h3> <b>&nbsp;&nbsp;:&nbsp;&nbsp;</b> </h3></td><td><h3><?= $model->NIY; ?></h3></td>
            </tr> 
            <tr>
                <td><h3><b>Nama</b></h3></td><td><h3> <b>&nbsp;&nbsp;:&nbsp;&nbsp;</b> </h3></td><td><h3><?= $model->nama; ?></h3></td>
            </tr>    
            </table>
            </div>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <p>
                    <?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/1.png' class='tombolmenu'>",['data-diri/create'],['class'=>'btn']) ?></p>
            </div>
                
            <div class="col-lg-3">
                    <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/2.png' class='tombolmenu'>",['pendidikan/index'],['class'=>'btn']) ?></p>
                </div>
                
            <div class="col-lg-3">
                    <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/3.png' class='tombolmenu'>",['pelatihan/index'],['class'=>'btn']) ?></p>
                </div>
            <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/4.png' class='tombolmenu'>",['pengajaran/index'],['class'=>'btn ']) ?></p>
            </div>
        </div>
          <div class="row">
            <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/7.png' class='tombolmenu'>",['buku/index'],['class'=>'btn ']) ?></p>
                
            </div>
            <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/7_1.png' class='tombolmenu'>",['jurnal/index'],['class'=>'btn ']) ?></p>
                
            </div>
                
            <div class="col-lg-3">
                    <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/8.png' class='tombolmenu'>",['makalah/index'],['class'=>'btn ']) ?></p>
                </div>
                
            <div class="col-lg-3">
                    <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/9.png' class='tombolmenu'>",['resensi/index'],['class'=>'btn ']) ?></p>
            </div>
            
        </div>
        
<!--        ---------------------------------------------------------------------------------------------------->
        <div class="row">
            
            <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/11.png' class='tombolmenu'>",['pengabdian/index'],['class'=>'btn ']) ?></p>
            </div>
        <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/5.png' class='tombolmenu'>",['produk-ajar/index'],['class'=>'btn ']) ?></p>
            </div>
            
        <div class="col-lg-3">
               <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/6.png' class='tombolmenu'>",['penelitian/index'],['class'=>'btn ']) ?></p>
            </div>
            <div class="col-lg-3">
               <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/10.png' class='tombolmenu'>",['konferensi/index'],['class'=>'btn ']) ?></p>
            </div>
            
           
        </div>
        
<!--        ------------------------------------------------------------------------------------------------------>
        
      
<!--        ------------------------------------------------------------------------------------------------------>
        
        <div class="row">
            
            <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/12.png' class='tombolmenu'>",['jabatan/index'],['class'=>'btn ']) ?></p>
            </div>
             <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/13.png' class='tombolmenu'>",['kegiatan/index'],['class'=>'btn ']) ?></p>
            </div>
      
       
            
              <div class="col-lg-3">
               <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/14.png' class='tombolmenu'>",['penghargaan/index'],['class'=>'btn']) ?></p>
            </div>
            
            <div class="col-lg-3">
                <p><?= Html::a("<img src='".Yii::$app->view->theme->baseUrl."/assets/img/15.png' class='tombolmenu'>",['organisasi/index'],['class'=>'btn ']) ?></p>
            </div>
           
        </div>
<!--        ------------------------------------------------------------------------------------>
        
        

    </div>
    
</div>
