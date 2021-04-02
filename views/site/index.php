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
    $total_ajar += $value->sks_bkd;
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

$exp = $total_bkd * 1000;
$level = MasterLevel::getLevel($exp);
$results = GameLevelClass::getCurrentClass($level);
$nextLevel = MasterLevel::getNextLevel($exp);
$remainingExp = $nextLevel['nextExp'] - $exp;
?>
<h1>Pencapaian Anda Semester ini (<?=$tahun_akademik['nama_tahun'];?>)</h1>
<h4><?=\app\helpers\MyHelper::convertTanggalIndo($tahun_akademik['kuliah_mulai']);?> sampai dengan <?=\app\helpers\MyHelper::convertTanggalIndo($tahun_akademik['nilai_selesai']);?></h4>
<div class="row">
    <div class="col-md-12">	
        <div class="panel">
            <div class="panel-heading">
            	<h3>Anda telah mencapai tingkatan <?=$results['rank'];?> dengan <?=$results['stars'];?> bintang kelas <?=$results['class'];?></h3>
            </div>
            <div class="panel-body">
            	<div class="alert alert-info">
       
                 Level Anda sekarang : <strong><?=$level;?></strong>. Anda perlu <strong><?=$remainingExp;?></strong> exp lagi untuk mencapai level berikutnya. 
                </div>
            </div>
        </div>
    </div>
</div>   
