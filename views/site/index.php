<?php
use app\helpers\MyHelper;
use yii\helpers\Html;
use app\models\MasterLevel;
use app\models\GameLevelClass;
use app\assets\IntroAsset;
IntroAsset::register($this);
/* @var $this yii\web\View */

$this->title = 'UNIDA Gontor Lecturer Data';
$total_abdi = 0;
$total_penunjang = 0;
$total_ajar = 0;
$total_pub = 0;
$total_ajar = 0; 
foreach ($pengajaran as $key => $value) 
{
    if($value->is_claimed == '1')
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
$num_bkd_pub = $bkd_pub->nilai_minimal ?: 1;
$num_bkd_abdi = $bkd_abdi->nilai_minimal ?: 1;
$num_bkd_penunjang = $bkd_penunjang->nilai_minimal ?: 1;
$persen_a = round(($total_ajar) / ($num_bkd_ajar) * 100,2);
$persen_b = !empty($num_bkd_pub) ? round(($total_pub) / ($num_bkd_pub) * 100,2) : 0;
$persen_c = !empty($num_bkd_abdi) ? round(($total_abdi) / ($num_bkd_abdi) * 100,2) : 0;
$persen_d = !empty($num_bkd_penunjang) ? round(($total_penunjang) / ($num_bkd_penunjang) * 100,2) : 0;

if($persen_a >= 100){
    $label_a = 'progress-bar-success';
}

else if($persen_a > 50){
    $label_a = 'progress-bar-warning';
}

else {
    $label_a = 'progress-bar-danger';
}

if($persen_b >= 100){
    $label_b = 'progress-bar-success';
}

else if($persen_b > 50){
    $label_b = 'progress-bar-warning';
}

else {
    $label_b = 'progress-bar-danger';
}

if($persen_c >= 100){
    $label_c = 'progress-bar-success';
}

else if($persen_c > 50){
    $label_c = 'progress-bar-warning';
}

else {
    $label_c = 'progress-bar-danger';
}

if($persen_d >= 100){
    $label_d = 'progress-bar-success';
}

else if($persen_d > 50){
    $label_d = 'progress-bar-warning';
}

else {
    $label_d = 'progress-bar-danger';
}

$is_cukup_ab = false;
$label_ab = '';
$is_cukup_cd = false;
$label_cd = '';
$status_dosen = $user->dataDiri->tugasDosen->id;

if($status_dosen == 'DT')
{
    $is_cukup_ab = $total_ajar > $num_bkd_ajar;
   
    $is_cukup_cd = true;
}

else if($status_dosen == 'DS')
{
    $is_cukup_ab = ($total_ajar > $num_bkd_ajar && $total_pub > $num_bkd_pub);

    if((!empty($total_abdi) && !empty($total_penunjang)) && ($total_abdi > $num_bkd_abdi && $total_penunjang > $num_bkd_penunjang))
    {
        $is_cukup_cd = $total_abdi + $total_penunjang >= 3;
    }
}

else if($status_dosen == 'PS')
{
    $is_cukup_ab = ($total_ajar > $num_bkd_ajar && $total_pub > $num_bkd_pub);
    if($total_abdi > $num_bkd_abdi && $total_penunjang > $num_bkd_penunjang)
    {
        $is_cukup_cd = $total_abdi + $total_penunjang >= 3;
    }
}

else if($status_dosen == 'PT')
{
    $is_cukup_ab = $total_ajar > $num_bkd_ajar;
    $is_cukup_cd = true;
}


if($is_cukup_ab){
    $label_ab = '<span style="color:#5cb85c"><i class="lnr lnr-thumbs-up"></i> sudah mencukupi</label>';
}

else{
    $label_ab = '<span style="color:#d9534f"><i class="lnr lnr-thumbs-down"></i> belum mencukupi</label>';
}

if($is_cukup_cd){
    $label_cd = '<span style="color:#5cb85c"><i class="lnr lnr-thumbs-up"></i> sudah mencukupi</label>';
}

else{
    $label_cd = '<span style="color:#d9534f"><i class="lnr lnr-thumbs-down"></i> belum mencukupi</label>';
}
?>
<h1>Pencapaian Anda Semester ini (<?=$bkd_periode->nama_periode;?>)</h1>
<h4><?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_awal);?> sampai dengan <?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_akhir);?></h4>
<div class="row" data-step="1" data-intro="Yuk, ikuti tur pengenalan fitur baru, yaitu Beban Kinerja Dosen atau yang biasa disebut BKD" data-title="Selamat datang di E-Khidmah">
    <div class="col-md-6">
    
        <div class="panel" data-step="2" data-intro="Progres Anda Selama Satu Semester" >
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
        <div class="panel" data-step="3" data-title="Summary Report" data-intro="Kinerja ini dihitung secara keseluruhan sesuai aturan BKD yang terbaru">
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
                    <li data-step="4" data-title="Indikator kinerja Anda dari Pengajaran & Penelitian" data-intro="Sudah mencukupi jika beban minimal BKD terpenuhi">
                            Kegiatan Pengajaran dan Penelitian Anda <?=$label_ab;?>
                    </li>
                    <li data-step="5" data-title="Indikator kinerja Anda dari Pengabdian & Penunjang" data-intro="Sudah mencukupi jika beban minimal BKD terpenuhi">
                        Kegiatan Pengabdian dan Penunjang Anda <?=$label_cd;?>
                    </li>
                    
                </ul>
                 
                </div>
            </div>
        </div>
    </div>

    
                        
</div>   


<?php

$this->registerJs('
 var introguide = introJs();
    introguide.setOptions({
        exitOnOverlayClick: false
    });
    // introguide.start();
    // // localStorage.clear();
    var doneTour = localStorage.getItem(\'evt_pa\') === \'Completed\';
    
    if(!doneTour) {
        introguide.start()

        introguide.oncomplete(function () {
            localStorage.setItem(\'evt_pa\', \'Completed\');
            Swal.fire({
              title: \'Ulangi Langkah Fitur ini ?\',
              text: "",
              icon: \'warning\',
              showCancelButton: true,
              width:\'35%\',
              confirmButtonColor: \'#3085d6\',
              cancelButtonColor: \'#d33\',
              confirmButtonText: \'Ya, ulangi lagi!\',
              cancelButtonText: \'Tidak, sudah cukup\'
            }).then((result) => {
              if (result.value) {
                introguide.start();
                localStorage.removeItem(\'evt_pa\');
              }

            });
        });

       
    }
', \yii\web\View::POS_READY);

?>
