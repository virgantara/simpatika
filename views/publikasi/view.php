<?php

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
                        'kegiatan_id',
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
                <?=\app\helpers\MyHelper::convertTanggalIndo($results->tanggal_terbit);?>
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
                </tr>
                </thead>

                <tbody>
                <?php 
                if(!empty($results->data_penulis))
                {
                    foreach($results->data_penulis as $q=>$author)
                    {

                ?>
                <tr>
                <td ><?=$q+1;?></td>
                <td><?=$author->nama;?></td>
                <td><?=$author->no_urut;?></td>
                <td><?=$author->afiliasi_penulis;?></td>
                <td><?=$author->peran_dalam_kegiatan;?></td>
                <td><?=$author->apakah_corresponding_author == 1 ? 'Ya' : 'Bukan';?></td>

                </tr>
                <?php 
                    }
                }
                ?>
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
</div>