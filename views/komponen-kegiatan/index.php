<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel common\models\KomponenKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unsur Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komponen-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
    foreach($unsurUtama as $q => $v)
    {
    ?>
    <h2><?=$v->urutan;?>. <?=$v->nama;?></h2>
    <table class="table" style="margin-bottom: 50px">
        <thead>
            <tr>
                <th>No</th>
                
                <th>Komponen Kegiatan</th>
                <th>Sub Komponen</th>
                <th>Angka Kredit</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
         
            <?php 
                foreach($v->komponenKegiatans as $key => $kom)
                {
            ?>
            <tr>
                <td><span class="<?=$v->id;?>_numbering"><?=($key+1);?></span></td>
                <td><input type="text" class="form-control input-nama" value="<?=$kom->nama;?>"></td>
                <td><input type="text" class="form-control input-subunsur" value="<?=$kom->subunsur;?>"></td>
                <td><input type="text" class="input-angka-kredit" style="width:70px"  value="<?=$kom->angka_kredit;?>"></td>
                <td>
                    <?=Html::a('<i class="fa fa-save"></i> ','javascript:void(0)',['class'=>'btn btn-primary btn-add','data-item'=>$v->id]);?>
                    <?=Html::a('<i class="fa fa-trash"></i> ','javascript:void(0)',['class'=>'btn btn-danger btn-remove','data-item'=>$v->id, 'data-value'=>$kom->id]);?>
                </td>
            </tr>
            <?php
                } 
            
            ?>
            <tr>
                <td colspan="4">
                    <?=Html::a('<i class="fa fa-plus"></i> Tambah Komponen','javascript:void(0)',['class'=>'btn btn-success btn-tambah-komponen','data-item'=>$v->id]);?>
                </td>
            </tr>
        </tbody>
    </table>

    <?php
        } 
    
    ?>
</div>

<?php 

$this->registerJs(' 

$(document).on("click",".btn-tambah-komponen",function(e){
    e.preventDefault()
    var unsur = $(this).data(\'item\')
    var row = "<tr>"
    row += "<td><span class=\'"+unsur+"_numbering\'></span></td>"
    row += "<td><input type=\'text\' class=\'form-control input-nama\' ></td>"
    row += "<td><input type=\'text\' class=\'form-control input-subunsur\' ></td>"
    row += "<td><input type=\'text\' style=\'width:70px\' class=\'input-angka-kredit\'></td>"
    row += "<td>"
    row += "<a href=\'\' class=\'btn btn-primary btn-add\' data-item=\'"+unsur+"\'><i class=\'fa fa-save\'></i></a> "
    row += "<a href=\'\' class=\'btn btn-danger btn-remove\' data-item=\'"+unsur+"\' data-value=\'0\'><i class=\'fa fa-trash\'></i> </a>"

    row += " </td>"
    row += "</tr>"

    $(this).parent().parent().before(row)

    refreshNumbering(unsur)

})

function refreshNumbering(unsur){
    var counter = 0
    $("span."+unsur+"_numbering").each(function(i,obj){
        counter++
        $(this).html(counter)
    })
}

$(document).on("click",".btn-remove",function(e){
    e.preventDefault()

    var unsur = $(this).data(\'item\')
    var id = $(this).data(\'value\')
    
    var selector = $(this)
    var obj = new Object
    obj.id = id
    
    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['komponen-kegiatan/ajax-remove']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            if(res.code == 200){
                selector.parent().parent().remove()
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

    });

    refreshNumbering(unsur)
})

$(document).on("click",".btn-add",function(e){
    e.preventDefault()

    var unsur = $(this).data(\'item\')
    var obj = new Object
    obj.unsur_id = unsur
    obj.nama =  $(this).parent().prev().prev().prev().find(".input-nama").val()
    obj.subunsur =  $(this).parent().prev().prev().find(".input-subunsur").val()
    obj.angka_kredit = eval($(this).parent().prev().find(".input-angka-kredit").val())
    var selector = $(this)

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['komponen-kegiatan/ajax-simpan']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
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

    });

    refreshNumbering(unsur)
})

', \yii\web\View::POS_READY);

?>