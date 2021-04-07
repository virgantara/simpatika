<?php
use app\helpers\MyHelper;
use yii\helpers\Html;
use app\models\MasterLevel;
use app\models\GameLevelClass;
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

// $exp = $total_bkd * 1000;
// $exp += $results['totalCatatanHarian'];
// $level = MasterLevel::getLevel($exp);
// $currentClass = GameLevelClass::getCurrentClass($level);
// $nextLevel = MasterLevel::getNextLevel($exp);
// $remainingExp = $nextLevel['nextExp'] - $exp;

$persen_a = 0;
$persen_b = 0;
$persen_c = 0;
$persen_d = 0;
$label_a = '';
$label_b = '';
$label_c = '';
$label_d = '';
$bkd_ajar = $bkd_ajar->nilai_minimal > 0 ? $bkd_ajar->nilai_minimal : 1;
$bkd_pub = $bkd_pub->nilai_minimal > 0 ? $bkd_pub->nilai_minimal : 1;
$bkd_abdi = $bkd_abdi->nilai_minimal > 0 ? $bkd_abdi->nilai_minimal : 1;
$bkd_penunjang = $bkd_penunjang->nilai_minimal > 0 ? $bkd_penunjang->nilai_minimal : 1;

$persen_a = round(($total_ajar) / ($bkd_ajar) * 100,2);

if($persen_a >= 100){
    $label_a = 'progress-bar-success';
}

else if($persen_a > 50){
    $label_a = 'progress-bar-warning';
}

else {
    $label_a = 'progress-bar-danger';
}
$persen_b = round(($total_pub) / ($bkd_pub) * 100,2);
if($persen_b >= 100){
    $label_b = 'progress-bar-success';
}

else if($persen_b > 50){
    $label_b = 'progress-bar-warning';
}

else {
    $label_b = 'progress-bar-danger';
}
$persen_c = round(($total_abdi) / ($bkd_abdi) * 100,2);
if($persen_c >= 100){
    $label_c = 'progress-bar-success';
}

else if($persen_c > 50){
    $label_c = 'progress-bar-warning';
}

else {
    $label_c = 'progress-bar-danger';
}
$persen_d = round(($total_penunjang) / ($bkd_penunjang) * 100,2);
if($persen_d >= 100){
    $label_d = 'progress-bar-success';
}

else if($persen_d > 50){
    $label_d = 'progress-bar-warning';
}

else {
    $label_d = 'progress-bar-danger';
}

?>
<h1>Pencapaian Anda Semester ini (<?=$tahun_akademik['nama_tahun'];?>)</h1>
<h4><?=\app\helpers\MyHelper::convertTanggalIndo($tahun_akademik['kuliah_mulai']);?> sampai dengan <?=\app\helpers\MyHelper::convertTanggalIndo($tahun_akademik['nilai_selesai']);?></h4>
<div class="row">
    <div class="col-md-6">
    
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">My Tasks</h3>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled task-list">
                    <li>
                        <p>Update Profil <span class="label-percent"><?=$results['persentaseProfil'];?>%</span></p>
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$results['persentaseProfil'];?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$results['persentaseProfil'];?>%">
                                <span class="sr-only"><?=$results['persentaseProfil'];?>% Complete</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <p>Pengajaran <span class="label-percent"><?=$persen_a;?>%</span></p>
                        <div class="progress progress-xs">
                            <div class="progress-bar <?=$label_a;?>" role="progressbar" aria-valuenow="<?=$persen_a;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen_a;?>%">
                                <span class="sr-only"><?=$persen_a;?>% Complete</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <p>Penelitian <span class="label-percent"><?=$persen_b;?>%</span></p>
                        <div class="progress progress-xs">
                            <div class="progress-bar <?=$label_b;?>" role="progressbar" aria-valuenow="<?=$persen_b;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen_b;?>%">
                                <span class="sr-only"><?=$persen_b;?>% Complete</span>
                            </div>
                        </div>
                    </li>
                   <li>
                        <p>Pengabdian <span class="label-percent"><?=$persen_c;?>%</span></p>
                        <div class="progress progress-xs">
                            <div class="progress-bar <?=$label_c;?>" role="progressbar" aria-valuenow="<?=$persen_c;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen_c;?>%">
                                <span class="sr-only"><?=$persen_c;?>% Complete</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <p>Penunjang <span class="label-percent"><?=$persen_d;?>%</span></p>
                        <div class="progress progress-xs">
                            <div class="progress-bar <?=$label_d;?>" role="progressbar" aria-valuenow="<?=$persen_d;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen_d;?>%">
                                <span class="sr-only"><?=$persen_d;?>% Complete</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END TASKS -->
    </div>
    <div class="col-md-6">	
        <div class="panel">
            <div class="panel-heading">
            	<h3 class="panel-title">Summary Reports</h3>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                
            	<div class="alert alert-default">
                     <ul >
                    <li>
                            Kegiatan Pengajaran dan Penelitian Anda
                            <?php 
                            $is_cukup_ab = false;
                            if($total_ajar > $bkd_ajar && $total_pub > $bkd_pub)
                            {
                                $is_cukup_ab = $persen_a + $persen_b >= 100;
                            }

                            if($is_cukup_ab){
                                echo '<span style="color:#5cb85c"><i class="lnr lnr-thumbs-up"></i> sudah mencukupi</label>';
                            }

                            else{
                                echo '<span style="color:#d9534f"><i class="lnr lnr-thumbs-down"></i> belum mencukupi</label>';
                            }
                            
                            ?>
                    </li>
                    <li>
                        Kegiatan Pengabdian dan Penunjang Anda
                        <?php 
                        $is_cukup_cd = false;
                        if($total_abdi > $bkd_abdi && $total_penunjang > $bkd_penunjang)
                        {
                            $is_cukup_cd = $persen_c + $persen_d >= 100;
                        }

                        if($is_cukup_cd){
                            echo '<span style="color:#5cb85c"><i class="lnr lnr-thumbs-up"></i> sudah mencukupi</label>';
                        }

                        else{
                            echo '<span style="color:#d9534f"><i class="lnr lnr-thumbs-down"></i> belum mencukupi</label>';
                        }
                        ?>
                    </li>
                    
                </ul>
                 
                </div>
            </div>
        </div>
    </div>

    
                        
</div>   
