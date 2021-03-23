<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataDiriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Dosen SIMPEG x FEEDER DIKTI';
$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title;

$list_jabfung = ArrayHelper::map(\app\models\MJabatanAkademik::find()->all(),'id','nama');
$list_pangkat = ArrayHelper::map(\app\models\MPangkat::find()->all(),'id',function($data){
    return $data->nama.' - '.$data->golongan;
});
?>



<div class="data-diri-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
      echo '<div class="alert alert-' . $key . '">' . $message . '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
    }
   
    ?>

    <div class="form-group">
        <?= Html::a('Fetch Kode from FEEDER DIKTI','javascript:void(0)', ['class' => 'btn btn-primary','id'=>'btn-sync-all']) ?>
    </div>


<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIY</th>
            <th>NIDN</th>
            
            <th>Kode Feeder</th>
            <th>ID REG PTK</th>
           
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($models as $q => $m)
        {
        ?>
        <tr>
            <td><?=$q+1;?></td>
            <td><?=$m->nama;?></td>
            <td><?=$m->NIY;?></td>
            <td><?=$m->NIDN;?></td>
          
            <td>
                <?=$m->kode_feeder;?>

            </td>
            <td><?=$m->id_reg_ptk;?></td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>
</div>
</div>

<?php

$this->registerJs(' 

$(document).on(\'click\',\'#btn-sync-all\',function(e){
    e.preventDefault();
    var obj = new Object;
    obj.prodi_id = $("#prodi").val();
    $.ajax({
        type: \'POST\',
        url: "'.Url::to(['data-diri/ajax-bulk-sync']).'",
        data: {
            dataPost : obj
        },
        async: true,
        error : function(e){
          Swal.hideLoading();
        

        },
        beforeSend: function(){
          Swal.showLoading();
        },
        success: function (data) {
          var hasil = $.parseJSON(data)
          Swal.hideLoading();
          if(hasil.code == 200){
            Swal.fire({
              title: \'Yeay!\',
              icon: \'success\',
              text: hasil.message
            }).then((result) => {
              if (result.value) {
                location.reload(); 
              }
            });
            
          }

          else{
            Swal.fire({
              title: \'Oops!\',
              icon: \'error\',
              text: hasil.message
            }).then((result) => {
              if (result.value) {
                location.reload(); 
              }
            });
          }
        }
    })
    
    
});


', \yii\web\View::POS_READY);

?>
