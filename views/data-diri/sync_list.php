<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataDiriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sinkronisasi Data Dosen SIMPEG x SIAKAD UNIDA Gontor';
$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title;

$list_jabfung = ArrayHelper::map(\app\models\MJabatanAkademik::find()->all(),'id','nama');
$list_pangkat = ArrayHelper::map(\app\models\MPangkat::find()->all(),'id',function($data){
    return $data->nama.' - '.$data->golongan;
});
?>



<div class="data-diri-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIY</th>
            <th>NIDN</th>
            <th>Jabfung/Pangkat</th>
            
            <th>Kode Unik/UUID</th>

            <th>Option</th>
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
            <td><?=Html::dropDownList('jabfung',$m->jabatan_fungsional,$list_jabfung,['class'=>'jabfung']);?><br>
            
                <?=Html::dropDownList('pangkat',$m->pangkat,$list_pangkat,['class'=>'pangkat']);?>
            </td>
            <td>
                
                <input type="text" style="width: 120px" readonly data-id="<?=$m->ID;?>" class="kode_unik" value="<?=$m->kode_unik;?>">   

                <input type="text" readonly class="uuid" value="<?=$m->nIY->uuid;?>">    

            </td>
            <td>
                <input type="text" class="nama_dosen" placeholder="Ketik nama dosen" >
                <?=Html::a('Update','javascript:void(0)',['class'=>'btn btn-primary btn-update','data-id'=>$m->ID]);?>
            </td>
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
 
$(document).on("click",".btn-update",function(e){
    e.preventDefault();
    var obj = new Object
    obj.dosen_id = $(this).data("id")
    obj.kode_unik = $(this).parent().prev().find(".kode_unik").val()
    obj.jabatan_fungsional = $(this).parent().prev().prev().find(".jabfung").val()
    obj.pangkat = $(this).parent().prev().prev().find(".pangkat").val()
    obj.uuid = $(this).parent().prev().find(".uuid").val()
    Swal.fire({
      title: \'Apakah Anda yakin?\',
      text: "Nama di SIAKAD akan diubah seperti nama di SIMPEG!",
      icon: \'warning\',
      showCancelButton: true,
      confirmButtonColor: \'#3085d6\',
      cancelButtonColor: \'#d33\',
      confirmButtonText: \'Ya, ubah sekarang!\'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            type: "POST",
            url: "'.Url::to(["data-diri/ajax-update"]).'",
            async: true,
            data: {
                dataPost: obj,
            },
            success: function (res) {
                var res = $.parseJSON(res);
                if(res.code == 200){
                    
                    Swal.fire({
                        title: \'Yeay!\',
                        icon: \'success\',
                        text: res.msg
                    });
                }

                else{
                    Swal.fire({
                        title: \'Oops!\',
                        icon: \'error\',
                        text: res.msg
                    }); 
                }
            }
        })
      }
    })
    
})

$(document).bind("keyup.autocomplete",function(){
    $(".nama_dosen").autocomplete({
        minLength:1,
        select:function(event, ui){
       
            $(this).parent().prev().find(".kode_unik").val(ui.item.nidn);
            $(this).parent().prev().find(".uuid").val(ui.item.uuid);
                
        },
      
        focus: function (event, ui) {
            $(this).parent().prev().find(".kode_unik").val(ui.item.nidn);
            $(this).parent().prev().find(".uuid").val(ui.item.uuid);
        },
        source:function(request, response) {
            $.ajax({
                url: "'.Url::to(["data-diri/ajax-cari-dosen"]).'",
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
', \yii\web\View::POS_READY);

?>
