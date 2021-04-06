<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Publikasi */

$this->title = $model->judul_publikasi_paten;
$this->params['breadcrumbs'][] = ['label' => 'Publikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
                        'id',
                        [
                            'attribute' => 'kegiatan_id',
                            'value' => function($data){
                                return $data->kegiatan->subunsur;
                            }
                        ],
                        'judul_publikasi_paten',
                        'nama_jenis_publikasi',
                        'tanggal_terbit',
                        'sister_id',
                        'updated_at',
                        'created_at',
                    ],
                ]) ?>

            </div>
        </div>

    </div>
    <?php 
    if(!empty($results))
    {


    ?>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                Detail Publikasi dari SISTER
            </div>

            <div class="panel-body ">
        
                
                <div class="row">

                <div class="col-md-12 col-md-12 col-xs-12">

                <table class="table table-striped table-bordered">
                <tbody><tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="judul" class="control-label">Judul Artikel</label>
                </div>

                <div class="col-lg-9">
                <?=$results->judul_publikasi_paten;?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="id_jns_pub" class="control-label">Jenis</label>
                </div>

                <div class="col-lg-9">
                <?=$results->nama_jenis_publikasi;?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="id_kat_capaian" class="control-label">Kategori Capaian</label>
                </div>

                <div class="col-lg-9">
                <?=$results->nama_kategori_pencapaian;?>
                </div></td>

                </tr>
                
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="nama_jurnal" class="control-label">Tautan Laman Jurnal</label>
                </div>

                <div class="col-lg-9">
                <a href="<?=$results->tautan_laman_jurnal;?>" target="_blank">Klik di sini</a>
                </div></td>

                </tr>
                
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="tgl_terbit" class="control-label">Tanggal Terbit</label>
                </div>

                <div class="col-lg-9">
                <?=!empty($results->tanggal_terbit) ? \app\helpers\MyHelper::convertTanggalIndo($results->tanggal_terbit) : '-';?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="vol" class="control-label">Volume</label>
                </div>

                <div class="col-lg-9">
                <?=$results->volume;?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="no" class="control-label">Nomor</label>
                </div>

                <div class="col-lg-9">
                <?=$results->nomor_hasil_publikasi;?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="hal" class="control-label">Halaman</label>
                </div>

                <div class="col-lg-9">
                <?=$results->halaman;?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="penerbit" class="control-label">Penerbit/Penyelenggara</label>
                </div>

                <div class="col-lg-9">
                <?=$results->nama_penerbit;?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="doi" class="control-label">DOI</label>
                </div>

                <div class="col-lg-9">
                <a href="<?=$results->DOI_publikasi;?>" target="_blank">Klik di sini</a>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="issn" class="control-label">ISSN</label>
                </div>

                <div class="col-lg-9">
                <?=$results->ISSN_publikasi;?>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="url" class="control-label">Tautan Eksternal</label>
                </div>

                <div class="col-lg-9">
                <a href="<?=$results->tautan;?>" target="_blank">Klik di sini</a>
                </div></td>

                </tr>
                <tr>
                <td class="form-group">
                <div class="col-lg-3">
                <label for="ket" class="control-label">Keterangan/Petunjuk Akses</label>
                </div>

                <div class="col-lg-9">
                <?=$results->keterangan;?>
                </div></td>

                </tr>
                </tbody></table>

                <div class="row" style="margin: 5px 0;"></div>
                
                <table class="table table-hover table-bordered table-striped">
                <thead>
                <tr>
                <th colspan="6" class="bg-dark">
                <i class="fa fa-users fa-fw"></i>
                Penulis Dosen
                </th>
                </tr>
                <tr>
                <th >No.</th>
                <th >Nama</th>
                <th >Urutan</th>
                <th >Afiliasi</th>
                <th >Peran</th>
                <th >Corresponding Author</th>
                <th>Option</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                if(!empty($model->publikasiAuthors))
                {
                    foreach($model->publikasiAuthors as $q=>$author)
                    {

                ?>
                <tr>
                <td ><?=$q+1;?></td>
                <td><?=$author->author_nama;?>
                    
                    <input type='hidden' value='<?=$author->NIY;?>' class='niy'>
                </td>
                <td><?=$author->urutan;?></td>
                <td><?=$author->afiliasi;?></td>
                <td><?=$author->peran_nama;?></td>
                <td><?=$author->corresponding_author == 1 ? 'Ya' : 'Bukan';?> </td>
                <td><button class='btn-remove-author btn btn-danger btn-sm'><i class='fa fa-trash'></i> </button></td>
                </tr>
                <?php 
                    }
                }
                ?>
                <tr>
                    <td colspan="6">
                    <a id="btn-add-author" href="javascript:void(0)" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Author</a>
                
                    </td>
                </tr>
                </tbody>

                </table>

                

                <div class="row" style="margin: 5px 0;"></div>
                <table class="table table-hover table-bordered table-striped">
                <thead>
                <tr>
                <th colspan="7" class="bg-dark">
                <i class="fa fa-file fa-fw"></i>
                Dokumen
                </th>
                </tr>

                <tr>
                <th >No.</th>
                <th>Nama Dokumen</th>
                <th>Nama File</th>
                <th>Jenis File</th>
                <th>Tanggal Upload</th>
                <th>Jenis Dokumen</th>
                <th>Tautan</th>
                <th>Aksi</th>
                </tr>
                </thead>

                <tbody>

                <?php 
                if(!empty($results->files))
                {
                    foreach($results->files as $q=>$file)
                    {

                
                ?>
                <tr>
                <td ><?=$q+1;?></td>
                <td><?=$file->nama_dokumen;?></td>
                <td><?=$file->nama_file;?></td>
                <td><?=$file->jenis_file;?></td>
                <td><?=$file->tanggal_upload;?></td>
                <td><?=$file->nama_jenis_dokumen;?></td>
                <td><a href="<?=$file->tautan;?>" target="_blank">Link</a></td>
                <td></td>
                </tr>
                <?php 
                    }
                }
                ?>
                </tbody>
                </table>


            </div>
        </div>

    </div>
    <?php 
    }
    ?>
</div>



<?php



$this->registerJs(' 


$(document).on("click",".btn-remove-author",function(e){
    e.preventDefault();

    var obj = new Object;
    obj.NIY = $(this).closest("tr").find("input.niy").val();
    obj.pub_id = "'.$model->id.'";
    
    $.ajax({
        url: "'.Url::to(["publikasi/ajax-remove-author"]).'",
        type: "POST",
        data: {
            dataPost: obj,
            
        },
        success: function (data) {

            var res = $.parseJSON(data)

            if(res.code == 200){
                Swal.fire(\'Yeay...\', res.message, \'success\')
            }

            else{
                Swal.fire(\'Oops...\', res.message, \'error\')
            }
        }
    })

})

$(document).on("click",".btn-save-author",function(e){
    e.preventDefault();

    var obj = new Object;
    obj.NIY = $(this).closest("tr").find("input.niy").val();
    obj.pub_id = "'.$model->id.'";
    obj.urutan = $(this).closest("tr").find("input.urutan").val();
    obj.afiliasi = $(this).closest("tr").find("input.afiliasi").val();
    obj.peran_id = $(this).closest("tr").find("select.peran_id").val();

    $.ajax({
        url: "'.Url::to(["publikasi/ajax-add-author"]).'",
        type: "POST",
        data: {
            dataPost: obj,
            
        },
        success: function (data) {

            var res = $.parseJSON(data)

            if(res.code == 200){
                Swal.fire(\'Yeay...\', res.message, \'success\')
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
    row += "<td><input type=\'number\' class=\'urutan\' style=\'width:100px\'></td>"
    row += "<td><input type=\'text\' class=\'afiliasi\' value=\'Universitas Darussalam Gontor\'></td>"
    row += "<td><select class=\'form-control peran_id\'><option value=\'A\'>Penulis</option><option value=\'B\'>Editor</option><option value=\'C\'>Penerjemah</option><option value=\'D\'>Penemu/Inventor</option></select></td>"
    row += "<td><input type=\'checkbox\' value=\'1\' class=\'apakah_corresponding_author\'></td>"
    row += "<td><button class=\'btn-save-author btn btn-primary btn-sm\'><i class=\'fa fa-plus\'></i> Add</button> <button class=\'btn-remove-author btn btn-danger btn-sm\'><i class=\'fa fa-trash\'></i> Remove</button></td>"
    row += "</tr>"

    $(this).parent().parent().before(row)
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
