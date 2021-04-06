<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'UNIDA Gontor Lecturer Data';
$total_abdi = 0;
$total_penunjang = 0;
?>
<h1>Progres BKD Anda Semester ini (<?=$bkd_periode->nama_periode;?>)</h1>
<h3>Tanggal <?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_awal);?> sampai dengan <?=\app\helpers\MyHelper::convertTanggalIndo($bkd_periode->tanggal_bkd_akhir);?></h3>

<div class="row">
    <div class="col-md-12">	
        <div class="panel">
            <div class="panel-heading">
            	
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
                        </tfoot>
            		</table>
            	</div>
            	
            </div>
        </div>
    </div>
</div>   


