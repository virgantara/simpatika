<?php
use app\helpers\MyHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'UNIDA Gontor Lecturer Data';

?>
<h1>Impor data dari SISTER</h1>

<div class="row">
    <div class="col-md-12">
        
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Sinkronisasi</h3>
                
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <?= Html::a('Import Now',[''], ['class' => 'btn btn-success','id'=>'btn-import']) ?>
                </div>
                <table class="table" id="tabel-sync">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Module</th>
                            <th>Data</th>
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
 

$(document).on("click","#btn-import",function(e){
    e.preventDefault()
    $.ajax({
        url: "'.Url::to(["site/ajax-import"]).'",
        type: "POST",
        beforeSend : function(){
            Swal.fire({
                title: \'Please Wait !\',
                html: \'data importing\',
                allowOutsideClick: false,
                showCancelButton: false, 
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
        },
        error : function(){
            Swal.close();
        },
        success: function (data) {
            Swal.close();
            var res = $.parseJSON(data)
            
            if(res.code == 200){
                $("#tabel-sync > tbody").empty();
                var row = "";
                $(res.items).each(function(i,obj){
                    row += "<tr>";
                    row += "<td>"+eval(i+1)+"</td>";
                    row += "<td>"+obj.modul+"</td>";
                    row += "<td>"+obj.data+"</td>";
                    row += "</tr>";
                })

                $("#tabel-sync > tbody").append(row);
                    
            }

            else{
                Swal.fire(\'Oops...\', res.message, \'error\')
            }
        }
    })
}); 
', \yii\web\View::POS_READY);

?>
