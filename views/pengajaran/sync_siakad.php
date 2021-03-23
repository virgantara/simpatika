<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Sinkronisasi Pengajaran Dosen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::dropDownList('tahun','', [], ['id' => 'tahun_list','prompt'=>'- Pilih Tahun -']) ?>
    </p>
    <?=Html::a('<i class="lnr lnr-sync"></i> Sync Now','#',['class'=>'btn btn-primary btn-sync']);?>
</div>


<?php 

$this->registerJs(' 

$(document).on("click",".btn-sync",function(e){
    e.preventDefault();

    // let prodi_id = $(this).data("item")
    let tahun = $("#tahun_list").val()
    fetchJadwal(tahun, function(err, res){
        if(err){
            console.log(err)
        }

        else{
            if(res){
                if(res.status == 200){
                    Swal.fire({
                      title: \'Yeay!\',
                      icon: \'success\',
                      text: res.message
                    }).then((result) => {
                      if (result.value) {
                         
                      }
                    });
                }

                else{
                    Swal.fire({
                      title: \'Oops!\',
                      icon: \'error\',
                      text: res.message
                    }).then((result) => {
                      if (result.value) {
                         
                      }
                    });
                }
            }
        }
        
    })
});

function fetchJadwal(tahun, callback){
    let obj = new Object;
    // obj.prodi_id = id;
    obj.tahun = tahun;
    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['pengajaran/ajax-jadwal']).'\',
        async: true,
        beforeSend : function(){
            Swal.showLoading()
        },
        error : function(e){

            Swal.fire({
              title: \'Oops!\',
              icon: \'error\',
              text: e.responseText
            }).then((result) => {
              if (result.value) {
                 
              }
            });
            Swal.hideLoading();
        },
        success: function(res){
            
            var res = $.parseJSON(res);
            if(res)
                callback(null, res)
            else
                callback(res, null)
        }

    });
}


getTahunList(function(err, res){
    $("#tahun_list").empty()
    var row = ""
    $.each(res, function(i, obj){
        row += "<option value=\'"+obj.tahun_id+"\'>"+obj.nama_tahun+"</option>"
    })

    $("#tahun_list").append(row)


    $("#tahun_list").trigger("change")
})

function getTahunList(callback){
    $.ajax({
        type : \'POST\',
        
        url : \''.Url::to(['site/ajax-tahun-list']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            callback(null, res)
        }

    });
}
', \yii\web\View::POS_READY);

?>