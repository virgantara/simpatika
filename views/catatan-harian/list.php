<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\daterange\DateRangePicker;

$listUnitku = $user->unitKerjas;
/* @var $this yii\web\View */
/* @var $model app\models\CatatanHarian */

$this->title = 'Monitoring Catatan Harian';
$this->params['breadcrumbs'][] = ['label' => 'Catatan Harians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
  table > tbody > tr > td {
    font-size: 18px
  }
</style>
<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
              <h2><?= Html::encode($this->title) ?></h2>  
              
            </div>

            <div class="panel-body ">
                <form>
                  <div class="form-group">
                    <label class="control-label">Unit Kerja</label>
                    
                    <?=Html::dropDownList('unker_id','',ArrayHelper::map($listUnitku,'id','nama'),['prompt' => '- Pilih Unit Kerja -','class'=>'form-control input-lg','id' => 'unker_id']);?>            
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label">Periode</label>
                    
                    <?php 
                    echo DateRangePicker::widget([
                        'name' => 'periode',
                        'attribute'=>'periode',
                        'convertFormat'=>true,
                        'options' => [
                          'id' => 'periode',
                          'class' => 'form-control'
                        ],
                        'pluginOptions'=>[
                            'timePicker'=>true,
                            'timePickerIncrement'=>30,
                            'locale'=>[
                                'format'=>'Y-m-d'
                            ]
                        ]
                    ]);
                    ?>   
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label">Dosen / Staf</label>
                    
                    <?=Html::dropDownList('pegawai_id','',[],['prompt' => '- Pilih Dosen/Staf -','class'=>'form-control input-lg','id'=>'pegawai_id']);?>            
                    
                  </div>
                  
                </form>
                <table class="table table-striped" id="table-user">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unsur Utama</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Poin</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>



<?php

$this->registerJs(' 
 
$(document).on("change","#unker_id",function(){

  let obj = new Object;
  obj.unker_id = $(this).val();

  $.ajax({
    url: "'.Url::to(["unit-kerja/ajax-list-pegawai"]).'",
    type: "POST",
    data: {
        dataPost: obj,
        
    },
    success: function (data) {
        let hasil = $.parseJSON(data)
        var row = "";

        $(hasil).each(function(i,obj){
          row += "<option value=\'"+obj.id+"\'>"+obj.nama+"</option>";
        });

        $("#pegawai_id").append(row);
    }
  })
}); 

$(document).on("change","#pegawai_id",function(){

  let obj = new Object;
  obj.user_id = $(this).val();
  obj.periode = $("#periode").val();

  $.ajax({
    url: "'.Url::to(["catatan-harian/ajax-list-catatan"]).'",
    type: "POST",
    data: {
        dataPost: obj,
        
    },
    success: function (data) {
        let hasil = $.parseJSON(data)
        var row = "";
        $("#table-user > tbody").empty();
        $(hasil).each(function(i,obj){
          row += "<tr>";
          row += "<td>"+eval(i+1)+"</td>";
          row += "<td>"+obj.unsur_nama+"</td>";
          row += "<td>"+obj.deskripsi+"</td>";
          row += "<td>"+obj.tanggal+"</td>";
          row += "<td>"+obj.poin+"</td>";
          row += "<td>";
          row += "<a class=\'btn btn-success btn-lg\'><i class=\'fa fa-check\'></i> Setujui</a> "
          row += "<a class=\'btn btn-danger btn-lg\'><i class=\'fa fa-ban\'></i> Tolak</a>"
          row += "</td>";
          row += "</tr>";
        });

        $("#table-user > tbody").append(row);
    }
  })
}); 

', \yii\web\View::POS_READY);

?>
