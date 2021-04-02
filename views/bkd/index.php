<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'UNIDA Gontor Lecturer Data';
$total_abdi = 0;
$total_penunjang = 0;
?>
<h1>Progres BKD Anda Semester ini (<?=$tahun_akademik['nama_tahun'];?>)</h1>
<h3>Tanggal <?=\app\helpers\MyHelper::convertTanggalIndo($tahun_akademik['kuliah_mulai']);?> sampai dengan <?=\app\helpers\MyHelper::convertTanggalIndo($tahun_akademik['nilai_selesai']);?></h3>
<div class="row">
    <div class="col-md-12">	
        <div class="panel">
            <div class="panel-heading">
            	Pendidikan
            </div>
            <div class="panel-body">
            	<div class="table-responsive">
            		<table class="table table-striped table-hover">
            			<thead>
            				<tr>
            					<th>No</th>
            					<th class="text-center">Kegiatan</th>
            					<th class="text-center">Beban Kredit</th>
            					
            			    </tr>
            			</thead>
            			<tbody>
            				<?php

            				$total_ajar = 0; 
            				foreach ($pengajaran as $key => $value) 
            				{
            					# code...
            					$total_ajar += $value->sks_bkd;
            				?>
            				<tr>
            					<td><?=$key+1;?></td>
            					<td>Mengajar mata kuliah <?=$value->matkul;?> kode <?=$value->kode_mk;?> kelas <?=$value->kelas;?> <?=$value->sks;?> sks.</td>
            					<td class="text-center"><?=$value->sks_bkd;?></td>
            				</tr>
            				<?php 
            				}
            				?>
            			</tbody>
            			
            		</table>
            	</div>
            	
            </div>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-md-12"> 
        <div class="panel">
            <div class="panel-heading">
                Penelitian/Publikasi
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Kegiatan</th>
                                <th class="text-center">Tanggal Terbit</th>
                                <th class="text-center">Beban Kredit</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $total_pub = 0; 
                            foreach ($publikasi as $key => $value) 
                            {
                                # code...
                                $total_pub += $value->sks_bkd;
                            ?>
                            <tr>
                                <td><?=$key+1;?></td>
                                <td>Melakukan publikasi <?=$value->nama_jenis_publikasi;?> dengan judul <?=$value->judul_publikasi_paten;?></td>
                                <td><?=$value->tanggal_terbit;?></td>
                                <td class="text-center"><?=$value->sks_bkd;?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-md-12"> 
        <div class="panel">
            <div class="panel-heading">
                Pengabdian
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Kegiatan</th>
                                <th class="text-center">Tanggal Terbit</th>
                                <th class="text-center">Beban Kredit</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            
                            foreach ($pengabdian as $key => $value) 
                            {
                                # code...
                                $total_abdi += $value->nilai;
                            ?>
                            <tr>
                                <td><?=$key+1;?></td>
                                <td>Melakukan pengabdian <?=$value->judul_penelitian_pengabdian;?> di <?=$value->tempat_kegiatan;?> </td>
                                <td><?=$value->tahun_kegiatan;?></td>
                                <td class="text-center"><?=$value->nilai;?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-md-12"> 
        <div class="panel">
            <div class="panel-heading">
                Penunjang
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Kegiatan</th>
                                <th class="text-center">Beban Kredit</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $counter=0;
                            foreach ($organisasi as $key => $value) 
                            {
                                # code...
                                $total_penunjang += $value->sks_bkd;
                                $counter++;
                            ?>
                            <tr>
                                <td><?=$counter;?></td>
                                <td>Menjadi <?=$value->jabatan;?> di <?=$value->organisasi;?> </td>
                                <td class="text-center"><?=$value->sks_bkd;?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php

                            
                            foreach ($pengelolaJurnal as $key => $value) 
                            {
                                # code...
                                $total_penunjang += $value->sks_bkd;
                                $counter++;
                            ?>
                            <tr>
                                <td><?=$counter;?></td>
                                <td>Menjadi <?=$value->peran_dalam_kegiatan;?> di <?=$value->nama_media_publikasi;?> </td>
                                <td class="text-center"><?=$value->sks_bkd;?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-md-12"> 
        <div class="panel">
            <div class="panel-heading">
                Summary Report
            </div>
            <div class="panel-body">
                <ul>
                	<li>Total Pengajaran Anda sebesar <strong><?=$total_ajar;?> sks</strong>. Syarat minimal adalah <strong><?=$bkd_ajar->nilai_minimal;?> sks</strong>. </li>
                	<li>Total Penelitian Anda sebesar <strong><?=$total_pub;?> sks</strong>. Syarat minimal adalah <strong><?=!empty($bkd_pub->nilai_minimal) ? $bkd_pub->nilai_minimal.' sks' : 'boleh kosong';?></strong>. </li>
                	<li>Total Pengajaran + Penelitian Anda sebesar <strong><?=$total_ajar + $total_pub;?> sks</strong></li>
                	<li>Total Pengabdian Anda sebesar <strong><?=$total_abdi;?> sks</strong>. Syarat minimal adalah <strong><?=!empty($bkd_abdi->nilai_minimal) ? $bkd_abdi->nilai_minimal.' sks' : 'boleh kosong';?></strong>. </li>
                	<li>Total Penunjang Anda sebesar <strong><?=$total_penunjang;?> sks</strong>. Syarat minimal adalah <strong><?=!empty($bkd_penunjang->nilai_minimal) ? $bkd_penunjang->nilai_minimal.' sks' : 'boleh kosong';?></strong>. </li>
                	<li>Total Pengabdian + Penunjang Anda sebesar <strong><?=$total_abdi + $total_penunjang;?> sks</strong></li>
                </ul>
                <h2>Total BKD Anda : <?=$total_ajar+$total_pub+$total_abdi+$total_penunjang;?> sks</h2>
            </div>
        </div>
    </div>
</div> 