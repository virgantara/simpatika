<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JabatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jabatan Dalam Institusi';
//$this->params['breadcrumbs'][] = $this->title;


?>

<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
              <h2><?= Html::encode($this->title) ?></h2>  
              
            </div>

            <div class="panel-body">
                
                    <form>
                      <div class="form-group">
                        <label class="control-label">Unit Kerja</label>
                        
                        <?=Html::dropDownList('unker_id','',$listUnker,['prompt' => '- Pilih Unit Kerja -','class'=>'form-control input-lg','id' => 'unker_id']);?>            
                        
                      </div>
           
                    </form>
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-user">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Staf</th>
                                <th>NIY</th>
                                <th>Jabatan</th>
                                <th>TMT</th>
                                <th>Bukti Penugasan</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                    </div>
                    <div class="row" id="modal" style="display: none" >
                        <div class="col-md-12">
                    <form>
                        <div class="form-group">
                            <label class="control-label">Nama</label>
                            <input type="hidden" name="unker_id" id="unit_kerja_id">
                            <input type="text" name="nama_staf" id="nama_staf" placeholder="Ketik nama dosen/tendik" class="form-control">
                            <input type="hidden" id="user_id">           
                        
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jabatan</label>
                             <?=Html::dropDownList('jabatan_id','',$listJabatan,['prompt' => '- Pilih Jabatan -','class'=>'form-control','id' => 'jabatan_id']);?>   
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label">TMT</label>
                             <?=DatePicker::widget([
                                'name' => 'tanggal', 
                                'value' => date('Y-m-d', strtotime('0 days')),
                                'options' => ['placeholder' => 'Pilih TMT ...','id'=>'tmt'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true
                                ]
                             ]);?>   
                            
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-primary" id="btn-save-pegawai"><i class="fa fa-save"></i> Simpan</a>
                        </div>
                    </form>
                </div>
                    </div>
                    <a href="#" class="btn btn-primary" id="btn-add-pegawai"><i class="fa fa-plus"></i> Tambah Anggota</a>
                
            </div>
        </div>

    </div>
</div>



<?php

$this->registerJs(' 

$(document).on("click","#btn-add-pegawai",function(e){
  e.preventDefault();
  $("#modal").show();
}); 


$(document).on("click",".btn-remove",function(e){
  e.preventDefault();

  Swal.fire({
    title: \'Apakah Anda yakin?\',
    text: "Data ini akan dihapus",
    icon: \'warning\',
    showCancelButton: true,
    confirmButtonColor: \'#3085d6\',
    cancelButtonColor: \'#d33\',
    confirmButtonText: \'Ya, hapus sekarang!\'
  }).then((result) => {
    if (result.isConfirmed) {
      let obj = new Object;
      obj.id = $(this).data(\'item\');
      $.ajax({
        url: "'.Url::to(["unit-kerja/ajax-remove-anggota"]).'",
        type: "POST",
        data: {
            dataPost: obj,
            
        },
        success: function (data) {
            $("#modal").hide();
            let hasil = $.parseJSON(data)
            if(hasil.code == 200)
            {
              Swal.fire({
                title: \'Yeay!\',
                icon: \'success\',
                text: hasil.message
              }).then((result) => {
                if (result.value) {
                  $("#unker_id").trigger("change");
                }
              });
            }

            else{
                Swal.fire({
                    title: \'Oops!\',
                    icon: \'error\',
                    text: hasil.message
                }); 
                console.log(hasil.message);
            }
        }
      })
     
    }
  })

  
}); 

$(document).on("click","#btn-save-pegawai",function(e){
  e.preventDefault();
  let obj = new Object;
  obj.unker_id = $("#unit_kerja_id").val();
  obj.user_id = $("#user_id").val();
  obj.jabatan_id = $("#jabatan_id").val();
  obj.tmt = $("#tmt").val();
  $.ajax({
    url: "'.Url::to(["unit-kerja/ajax-add-anggota"]).'",
    type: "POST",
    data: {
        dataPost: obj,
        
    },
    success: function (data) {
        $("#modal").hide();
        let hasil = $.parseJSON(data)
        if(hasil.code == 200)
        {
            $("#unker_id").trigger("change");

        }

        else{
            console.log(hasil.message);
        }
    }
  })
}); 


$(document).bind("keyup.autocomplete",function(){

    $(\'#nama_staf\').autocomplete({
        minLength:1,
            select:function(event, ui){
            $(this).next().val(ui.item.id);

        },
        focus: function (event, ui) {
            $(this).next().val(ui.item.id);

        },
        source:function(request, response) {
            $.ajax({
                url: "'.Url::to(['site/ajax-cari-user']).'",
                dataType: "json",
                data: {
                    term: request.term,
                    
                },
                success: function (data) {
                    response(data);
                }
            })
        },

    }); 
});

$(document).on("change","#unker_id",function(){

  let obj = new Object;
  obj.unker_id = $(this).val();
  $("#unit_kerja_id").val($(this).val());

  $.ajax({
    url: "'.Url::to(["unit-kerja/ajax-list-anggota"]).'",
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
          row += "<td>"+obj.nama+"</td>";
          row += "<td>"+obj.niy+"</td>";
          row += "<td>"+obj.jabatan+"</td>";
          row += "<td>"+obj.tmt+"</td>";
          row += "<td><a class=\'btn btn-primary\' target=\'_blank\' href=\'"+obj.file_penugasan+"\'>File Penugasan</a></td>";
          row += "<td><a data-item=\'"+obj.id+"\' class=\'btn-remove btn btn-danger\' href=\'#\'><i class=\'fa fa-trash\'></i> Remove</a></td>";
          row += "</tr>";
        });

        $("#table-user > tbody").append(row);
    }
  })
}); 



', \yii\web\View::POS_READY);

?>
