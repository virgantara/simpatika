<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'UNIDA Gontor Lecturer Data';
$total_abdi = 0;
$total_penunjang = 0;
$total_ajar = 0;
$total_pub = 0;
$total_ajar = 0; 
foreach ($pengajaran as $key => $value) 
{
    $total_ajar += $value->sks_bkd * $value->sks;
}

foreach ($publikasi as $key => $value) 
{
    $total_pub += $value->sks_bkd;
}

foreach ($pengabdian as $key => $value) 
{
    $total_abdi += $value->nilai;
}

foreach ($organisasi as $key => $value) 
{
    $total_penunjang += $value->sks_bkd;
}
foreach ($pengelolaJurnal as $key => $value) 
{
    $total_penunjang += $value->sks_bkd;
}

$total_bkd = $total_ajar+$total_pub+$total_abdi+$total_penunjang;

$persen_a = 0;
$persen_b = 0;
$persen_c = 0;
$persen_d = 0;
$label_a = '';
$label_b = '';
$label_c = '';
$label_d = '';
$num_bkd_ajar = $bkd_ajar->nilai_minimal > 0 ? $bkd_ajar->nilai_minimal : 1;
$num_bkd_pub = $bkd_pub->nilai_minimal;
$num_bkd_abdi = $bkd_abdi->nilai_minimal;
$num_bkd_penunjang = $bkd_penunjang->nilai_minimal;
$persen_a = round(($total_ajar) / ($num_bkd_ajar) * 100,2);
$persen_b = !empty($num_bkd_pub) ? round(($total_pub) / ($num_bkd_pub) * 100,2) : 0;
$persen_c = !empty($num_bkd_abdi) ? round(($total_abdi) / ($num_bkd_abdi) * 100,2) : 0;
$persen_d = !empty($num_bkd_penunjang) ? round(($total_penunjang) / ($num_bkd_penunjang) * 100,2) : 0;

$is_cukup_ab = false;
$label_ab = '';
if($total_ajar > $num_bkd_ajar && $total_pub > $num_bkd_pub)
{
    $is_cukup_ab = $persen_a + $persen_b >= 100;
}

else
{
    $is_cukup_ab = true;
}

if($is_cukup_ab){
    $label_ab = '<span style="color:#5cb85c"><i class="lnr lnr-thumbs-up"></i> sudah mencukupi</label>';
}

else{
    $label_ab = '<span style="color:#d9534f"><i class="lnr lnr-thumbs-down"></i> belum mencukupi</label>';
}

$is_cukup_cd = false;
$label_cd = '';

if(!empty($bkd_abdi->nilai_minimal) || !empty($bkd_penunjang->nilai_minimal))
{
    
    if($total_abdi > $num_bkd_abdi && $total_penunjang > $num_bkd_penunjang)
    {
        $is_cukup_cd = $persen_c + $persen_d >= 100;
    }
}

else{
    $is_cukup_cd = true;
}


if($is_cukup_cd){
    $label_cd = '<span style="color:#5cb85c"><i class="lnr lnr-thumbs-up"></i> sudah mencukupi</label>';
}

else{
    $label_cd = '<span style="color:#d9534f"><i class="lnr lnr-thumbs-down"></i> belum mencukupi</label>';
}

?>
<h1>Progres BKD Anda Semester ini (<?=$bkd_periode->nama_periode;?>)</h1>
<h3>Tanggal <?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_awal);?> sampai dengan <?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_akhir);?></h3>

<div class="row">
    <div class="col-md-12">	
        <div class="panel">
            <div class="panel-heading">
            	<?=Html::a('<i class="fa fa-print"></i> Cetak LKD',['bkd/print'],['class'=>'btn btn-success']);?>
            </div>
            <div class="panel-body">
            	<div class="table-responsive">
                    
            		<table class="table table-striped table-hover">
            			<thead>
            				<tr>
            					<th>No</th>
                                <th>Unsur Utama</th>
            					<th class="text-center">Kegiatan</th>
            					<th class="text-center">Beban Kredit</th>
            					
            			    </tr>
            			</thead>
            			<tbody>
                            <?php 
                            $counter = 0;
                            $total =0;
                            foreach ($results as $key => $value) 
                            {
                                if(empty($value['items'])) continue;
                            
                				$subtotal = 0; 
                				foreach ($value['items'] as $q => $v) 
                				{
                                    $counter++;

            					# code...
            					   $subtotal += $v->sks;
            				?>
            				<tr>
            					<td><?=$counter ;?></td>
                                <td><?=$value['unsur'];?></td>
            					<td><?=$v->deskripsi;?></td>
            					<td class="text-center"><?=$v->sks;?></td>
            				</tr>
                				<?php 
                				}

                                $total += $subtotal;
                				?>
            			</tbody>
            			<?php 
                        }
                        ?>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right">Total Kredit</td>
                                <td class="text-center"><?=$total;?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Kesimpulan</strong></td>
                                <td colspan="2">
                                    <p>
                                        Kegiatan Pengajaran dan Penelitian Anda <?=$label_ab;?>
                                    </p>
                                    <p>
                                        Kegiatan Pengabdian dan Penunjang Anda <?=$label_cd;?>
                                    </p>
                                </td>
                            </tr>

                        </tfoot>
            		</table>
            	</div>
            	
            </div>
        </div>
    </div>
</div>   


