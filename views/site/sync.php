<?php
use app\helpers\MyHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\IntroAsset;
IntroAsset::register($this);
$this->title = 'UNIDA Gontor Lecturer Data';

?>
<h1 >Impor data dari SISTER</h1>

<div class="row">
    <div class="col-md-12">
        
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Sinkronisasi</h3>
                
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <?= Html::a('Import Now',[''], [
                        'class' => 'btn btn-success',
                        'id'=>'btn-import',

                    ]) ?>
                </div>
                <table class="table" id="tabel-sync">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Module</th>
                            <th>Data</th>
                            <th>Source</th>
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
    
    var introguide = introJs();
    introguide.setOptions({
        exitOnOverlayClick: false,
        steps : [
            {
                intro: "Fitur ini mengambil data dari 2 sumber, yaitu SISTER dan SIAKAD",
                title: "Fitur Sinkronisasi",
                element : "h1"
            },
            {
                intro: "Klik Tombol ini untuk menjalankan proses import",
                title: "Tombol Sinkronisasi",
                element : "#btn-import"
            },
            {
                intro: "Hasil Sinkronisasi akan muncul di tabel ini",
                title: "Hasil Sinkronisasi",
                element : "#tabel-sync"
            },
        ]
    });

    var doneTour = localStorage.getItem(\'evt_sync\') === \'Completed\';
    
    if(!doneTour) {
        introguide.start()

        introguide.oncomplete(function () {
            localStorage.setItem(\'evt_sync\', \'Completed\');
            Swal.fire({
              title: \'Ulangi Langkah Fitur ini ?\',
              text: "",
              icon: \'warning\',
              showCancelButton: true,
              width:\'35%\',
              confirmButtonColor: \'#3085d6\',
              cancelButtonColor: \'#d33\',
              confirmButtonText: \'Ya, ulangi lagi!\',
              cancelButtonText: \'Tidak, sudah cukup\'
            }).then((result) => {
              if (result.value) {
                introguide.start();
                localStorage.removeItem(\'evt_sync\');
              }

            });
        });

    }

$(document).on("click","#btn-import",function(e){
    e.preventDefault()
    $.ajax({
        url: "'.Url::to(["site/ajax-import"]).'",
        type: "POST",
        beforeSend : function(){
            Swal.fire({
                title: \'Please Wait !\',
                html: \'Importing data\',
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
                    row += "<td>"+obj.source+"</td>";
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
