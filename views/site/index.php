<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'UNIDA Gontor Lecturer Data';
?>
<h1>Progres Anda Semester ini (<?=$tahun_akademik['nama_tahun'];?>)</h1>
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

                            $total_ajar = 0; 
                            foreach ($publikasi as $key => $value) 
                            {
                                # code...
                                $total_ajar += $value->sks_bkd;
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