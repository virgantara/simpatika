<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengabdian */

$this->title = $model->judul_penelitian_pengabdian;
$this->params['breadcrumbs'][] = ['label' => 'Pengabdians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$list_status = ['Ketua' ,'Anggota 1','Anggota 2','Anggota 3'];
$list_status = array_combine($list_status, $list_status);
?>
<div class="block-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

            <div class="panel-body ">
                        
                <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'ID',
                            'NIY',
                            'judul_penelitian_pengabdian',
                            'nama_tahun_ajaran',
                            'nama_skim',
                            'durasi_kegiatan',
                            'jenis_penelitian_pengabdian',
                            'nilai',
                            'sister_id',
                            'updated_at',
                            'created_at',
                        ],
                    ]) ?>

            </div>
        </div>

    </div>
     <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title">Anggota</h1>
            </div>
            <div class="panel-body">

        <table class="table table-hover table-bordered table-striped" id="table-anggota">
        <thead>
        <tr>
            <th >No.</th>
            <th >Nama</th>
            <th >Status</th>
            <th >Beban Kerja <br>(Jam / Minggu)</th>
            <th>Option</th>
        </tr>
        </thead>

        <tbody>
        <?php 
        if(!empty($model->pengabdianAnggotas))
        {
            foreach($model->pengabdianAnggotas as $q=>$author)
            {

        ?>
            <tr>
                <td ><span class="numbering"><?=$q+1;?></span></td>
                <td><?=$author->nIY->dataDiri->nama;?>
                    
                    <input type='hidden' value='<?=$author->NIY;?>' class='niy'>
                </td>
                <td><?=$author->status_anggota;?>
                    <?=Html::dropDownList('status_anggota',$author->status_anggota,$list_status,['class'=>'status','style'=>'display:none']);?>
                </td>
                <td><?=$author->beban_kerja;?><input type="text" class="beban_kerja" style="display: none"  value="<?=$author->beban_kerja;?>"></td>
            
                <td>
                    <button class='btn-edit-author-save btn btn-info btn-sm' style="display: none"><i class='fa fa-check'></i> Save</button>
                    <button class='btn-edit-author btn btn-info btn-sm'><i class='fa fa-edit'></i> </button>
                    <button class='btn-remove-author btn btn-danger btn-sm'><i class='fa fa-trash'></i> </button></td>
            </tr>
        <?php 
            }
        }
        ?>
        
        </tbody>
        <tfoot>
            <tr>
            <td colspan="6">
            <a id="btn-add-author" href="javascript:void(0)" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Author</a>
        
            </td>
        </tr>
        </tfoot>
    </table>
</div>
</div>
    </div>
</div>


<?php



$this->registerJs(' 

function refreshNumbering(){
    var num = 0;
    $("span.numbering").each(function(i,obj){
        num++
        $(this).html(num)
    })
}

function getListAnggota(){

    var obj = new Object;
    obj.pengabdian_id = "'.$model->ID.'";
   
    $.ajax({
        url: "'.Url::to(["pengabdian/ajax-list-anggota"]).'",
        type: "POST",
        data: {
            dataPost: obj,
            
        },
        beforeSend : function(){
            Swal.showLoading()
        },
        success: function (data) {
            Swal.hideLoading()
            var res = $.parseJSON(data)

            $("#table-anggota > tbody").empty()
            var row = "";
            $(res).each(function(i,obj){

                row += "<tr>"
                row += "<td><span class=\'numbering\'>"+eval(i+1)+"</span></td>"
                row += "<td>"+obj.nama+"<input type=\'hidden\' value=\'"+obj.NIY+"\' class=\'niy\'></td>"
                row += "<td>"+obj.status_anggota+"<select style=\'display:none\' class=\'form-control status\'><option value=\'Ketua\'>Ketua</option><option value=\'Anggota 1\'>Anggota 1</option><option value=\'Anggota 2\'>Anggota 2</option><option value=\'Anggota 3\'>Anggota 3</option></select></td>"
                row += "<td>"+obj.beban_kerja+"<input style=\'display:none\' type=\'text\' class=\'beban_kerja\' placeholder=\'jam / minggu\' value=\'"+obj.beban_kerja+"\'></td>"
                row += "<td>"
                row += "<button class=\'btn-edit-author-save btn btn-info btn-sm\' style=\'display: none\'><i class=\'fa fa-check\'></i> Save</button> "
                row += "    <button class=\'btn-edit-author btn btn-info btn-sm\'><i class=\'fa fa-edit\'></i> </button> "
                row += "<button class=\'btn-remove-author btn btn-danger btn-sm\'><i class=\'fa fa-trash\'></i></button></td>"
                row += "</tr>"
            })

            $("#table-anggota > tbody").append(row)
            refreshNumbering()
            
        }
    })

}

$(document).on("click",".btn-edit-author-save",function(e){
    e.preventDefault();

    var obj = new Object;
    obj.NIY = $(this).closest("tr").find("input.niy").val();
    obj.pengabdian_id = "'.$model->ID.'";
    obj.status_anggota = $(this).closest("tr").find("select.status").val();
    obj.beban_kerja = $(this).closest("tr").find("input.beban_kerja").val();

    $.ajax({
        url: "'.Url::to(["pengabdian/ajax-update-author"]).'",
        type: "POST",
        data: {
            dataPost: obj,
            
        },
        beforeSend : function(){
            Swal.showLoading()
        },
        success: function (data) {
            Swal.hideLoading()
            var res = $.parseJSON(data)

            if(res.code == 200){
                Swal.fire(\'Yeay...\', res.message, \'success\')
                getListAnggota()
            }

            else{
                Swal.fire(\'Oops...\', res.message, \'error\')
            }
        }
    })

    $(this).hide();
    $(this).next().show();
    $(this).closest("tr").find("select.status").hide();
    $(this).closest("tr").find("input.beban_kerja").hide();
})


$(document).on("click",".btn-edit-author",function(e){
    e.preventDefault();
    $(this).hide();
    $(this).prev().show();
    $(this).closest("tr").find("select.status").show();
    $(this).closest("tr").find("input.beban_kerja").show();
})

$(document).on("click",".btn-remove-author",function(e){
    e.preventDefault();
    Swal.fire({
      title: \'Are you sure?\',
      text: \'You will not be able to recover this data!\',
      icon: \'warning\',
      showCancelButton: true,
      confirmButtonText: \'Yes, delete it!\',
      cancelButtonText: \'No, keep it\'
    }).then((result) => {
      if (result.value) {
        var obj = new Object;
        obj.NIY = $(this).closest("tr").find("input.niy").val();
        obj.pengabdian_id = "'.$model->ID.'";
        
        $.ajax({
            url: "'.Url::to(["pengabdian/ajax-remove-author"]).'",
            type: "POST",
            data: {
                dataPost: obj,
                
            },
            beforeSend : function(){
                Swal.showLoading()
            },
            success: function (data) {
                Swal.hideLoading()
                var res = $.parseJSON(data)

                if(res.code == 200){
                    Swal.fire(\'Yeay...\', res.message, \'success\')
                    .then((res) => {
                        if(res.value){
                            getListAnggota()

                        }
                    })
                }

                else{
                    Swal.fire(\'Oops...\', res.message, \'error\')
                }
            }
        })
      } 
    })
    

})

$(document).on("click",".btn-save-author",function(e){
    e.preventDefault();

    var obj = new Object;
    obj.NIY = $(this).closest("tr").find("input.niy").val();
    obj.pengabdian_id = "'.$model->ID.'";
    obj.status_anggota = $(this).closest("tr").find("select.status").val();
    obj.beban_kerja = $(this).closest("tr").find("input.beban_kerja").val();

    $.ajax({
        url: "'.Url::to(["pengabdian/ajax-add-author"]).'",
        type: "POST",
        data: {
            dataPost: obj,
            
        },
        beforeSend : function(){
            Swal.showLoading()
        },
        success: function (data) {
            Swal.hideLoading()
            var res = $.parseJSON(data)

            if(res.code == 200){
                Swal.fire(
                    \'Yeay...\', 
                    res.message, 
                    \'success\'
                ).then((res)=>{
                    if(res.value){
                        getListAnggota()
                    }
                })

            }

            else{
                Swal.fire(\'Oops...\', res.message, \'error\')
            }
        }
    })

})

$(document).on("click","#btn-add-author",function(e){
    e.preventDefault();

    var row = "<tr>"
    row += "<td><span class=\'numbering\'></span></td>"
    row += "<td><input type=\'text\' class=\'form-control nama_dosen\'><input type=\'hidden\' class=\'niy\'></td>"
    row += "<td><select class=\'form-control status\'><option value=\'Ketua\'>Ketua</option><option value=\'Anggota 1\'>Anggota 1</option><option value=\'Anggota 2\'>Anggota 2</option><option value=\'Anggota 3\'>Anggota 3</option></select></td>"
    row += "<td><input type=\'text\' class=\'beban_kerja\' placeholder=\'jam / minggu\'></td>"
    row += "<td><button class=\'btn-save-author btn btn-primary btn-sm\'><i class=\'fa fa-plus\'></i> Add</button> <button class=\'btn-remove-author btn btn-danger btn-sm\'><i class=\'fa fa-trash\'></i> Remove</button></td>"
    row += "</tr>"
    $(this).closest("tfoot").prev().append(row)
    refreshNumbering()
    // $(this).parent().parent().before(row)
})


$(document).bind("keyup.autocomplete",function(){
    $(".nama_dosen").autocomplete({
        minLength:1,
        select:function(event, ui){
            $(this).next().val(ui.item.niy);
        },
      
        focus: function (event, ui) {
            $(this).next().val(ui.item.niy);
        },
        source:function(request, response) {
            $.ajax({
                url: "'.Url::to(["data-diri/ajax-cari-dosen-simpeg"]).'",
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
