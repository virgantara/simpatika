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
                        ],
                        'pluginEvents' =>[
                            "apply.daterangepicker" => "function(e) { 
                              $('#pegawai_id').trigger('change');
                            }",
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
          if(obj.is_selesai == "0"){
            row += "<a class=\'btn btn-success btn-lg btn-setuju\' data-item=\'"+obj.id+"\'><i class=\'fa fa-check\'></i> Setujui</a> "
            row += "<a class=\'btn btn-danger btn-lg btn-tolak\' data-item=\'"+obj.id+"\'><i class=\'fa fa-ban\'></i> Tolak</a>"
          }

          else if(obj.is_selesai == "1"){
            row += "<label class=\'label label-success\'><i class=\'fa fa-check\'></i> Approved</label>" 
          }

          else if(obj.is_selesai == "2"){
            row += "<label class=\'label label-danger\'><i class=\'fa fa-check\'></i> Rejected</label>" 
          }
          row += "</td>";
          row += "</tr>";
        });

        $("#table-user > tbody").append(row);
    }
  })
}); 

$(document).on("click",".btn-setuju",function(e){
  e.preventDefault();
  let obj = new Object;
  obj.id = $(this).data("item");

  $.ajax({
    url: "'.Url::to(["catatan-harian/ajax-setuju"]).'",
    type: "POST",
    data: {
        dataPost: obj,
        
    },
    beforeSend : function(){
      
    },
    success: function (data) {
        let hasil = $.parseJSON(data)
        
        if(hasil.code != 200){
          Swal.fire(
            \'Oops\',
            hasil.message,
            \'error\'
          )
        }

        else{
          $(\'#pegawai_id\').trigger(\'change\');
        }
    }
  })
})

$(document).on("click",".btn-tolak",function(e){
  e.preventDefault();
  let obj = new Object;
  obj.id = $(this).data("item");

  $.ajax({
    url: "'.Url::to(["catatan-harian/ajax-tolak"]).'",
    type: "POST",
    data: {
        dataPost: obj,
        
    },
    beforeSend : function(){
      
    },
    success: function (data) {
        let hasil = $.parseJSON(data)
        
        if(hasil.code != 200){
          Swal.fire(
            \'Oops\',
            hasil.message,
            \'error\'
          )
        }

        else{
          $(\'#pegawai_id\').trigger(\'change\');
        }
    }
  })
})

', \yii\web\View::POS_READY);

?>
