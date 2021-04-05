<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'UNIDA Gontor Lecturer Data';
$total_abdi = 0;
$total_penunjang = 0;
?>
<h1>Progres BKD Anda Semester ini (<?=$bkd_periode->nama_periode;?>)</h1>
<h3>Tanggal <?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_awal);?> sampai dengan <?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_akhir);?></h3>
<?php 
foreach ($results as $key => $value) 
{
    if(empty($value['items'])) continue;
?>
<div class="row">
    <div class="col-md-12">	
        <div class="panel">
            <div class="panel-heading">
            	<?=$value['unsur'];?>
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
            				foreach ($value['items'] as $q => $v) 
            				{

            					# code...
            					// $total_ajar += $value->sks_bkd;
            				?>
            				<tr>
            					<td><?=$q+1;?></td>
            					<td><?=$v->deskripsi;?></td>
            					<td class="text-center"><?=$v->sks;?></td>
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


<?php 
}
?>