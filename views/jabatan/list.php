<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JabatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jabatan Dalam Institusi';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-index">


<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
              <h2><?= Html::encode($this->title) ?></h2>  
              
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <form>
                      <div class="form-group">
                        <label class="control-label">Unit Kerja</label>
                        
                        <?=Html::dropDownList('unker_id','',$listJabatan,['prompt' => '- Pilih Unit Kerja -','class'=>'form-control input-lg','id' => 'unker_id']);?>            
                        
                      </div>
           
                    </form>

                    <table class="table table-striped" id="table-user">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Staf</th>
                                <th>NIY</th>
                                <th>Jabatan</th>
                                <th>TMT</th>
                                <th>Bukti Penugasan</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                    <div class="row" >
                        <div class="col-md-12">
                    <form>
                      <div class="form-group">
                        <label class="control-label">Nama</label>
                         <input type="text" name="unker_id" id="unit_kerja_id">
                        <input type="text" name="nama_staf" id="nama_staf" placeholder="Ketik nama dosen/tendik">
                        <input type="text" id="user_id">           
                        
                      </div>
           
                    </form>
                </div>
                    </div>
                    <a href="#" class="btn btn-primary" id="btn-add-pegawai"><i class="fa fa-plus"></i> Tambah Anggota</a>
                </div>
            </div>
        </div>

    </div>
</div>



<?php

$this->registerJs(' 
 
$(document).on("click","#btn-add-pegawai",function(){

  let obj = new Object;
  obj.unker_id = $("#unit_kerja_id").val();
  obj.user_id = $("#user_id").val();
  $.ajax({
    url: "'.Url::to(["unit-kerja/ajax-add-anggota"]).'",
    type: "POST",
    data: {
        dataPost: obj,
        
    },
    success: function (data) {
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
          row += "</tr>";
        });

        $("#table-user > tbody").append(row);
    }
  })
}); 



', \yii\web\View::POS_READY);

?>
