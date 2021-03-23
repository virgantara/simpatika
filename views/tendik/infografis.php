<?php 

$this->title = 'UNIDA Gontor Tenaga Kependidikan';
?>

<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">TABEL DATA TENAGA KEPENDIDIKAN</h3>
        <p class="panel-subtitle">Date day : <?=date('d M Y');?></p>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td style="text-align: center; vertical-align: middle;">Jenis Tenaga Kependidikan</td>
                            <?php 
                            $totals = [];
                              foreach($listJenjang as $item){
                                $totals[$item->kode] = 0;
                            ?>
                            <td><?=$item->kode;?></td>
                            <?php 
                             }
                            ?>
                           
                            <td>Jumlah</td>
                        </tr>
                        <tr>
                            <td>(1)</td>
                            <td>(2)</td>
                            <?php
                            $i = 3;
                             foreach($listJenjang as $item){
                                echo '<td>('.$i.')</td>';
                                $i++;
                             }
                            ?>
                           
                            <td>(11)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0;
                        $total = 0;
                        
                        foreach($listJT as $item){

                        ?>
                        <tr>
                            <td><?=($i+1);?></td>
                            <td><?=$item->nama;?></td>
                            <?php 
                            $subtotal_kanan = 0;
                            foreach($listJenjang as $sub){
                                $subtotal_kanan += $dataTable[$item->kode][$sub->kode];
                                $total += $dataTable[$item->kode][$sub->kode];
                                $totals[$sub->kode] += $dataTable[$item->kode][$sub->kode];
                            ?>
                            <td><a href="<?=\yii\helpers\Url::to(['/tendik/list','jenjang'=>$sub->kode,'jenis'=>$item->kode]);?>"><?=$dataTable[$item->kode][$sub->kode];?></a></td>
                            <?php 
                            }
                            ?>
                            <td><?=$subtotal_kanan;?></td>
                        </tr>
                       <?php
                       $i++; 
                   }
                       ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total</td>
                            <?php 
                            foreach($listJenjang as $item){
                                echo ' <td>'.$totals[$item->kode].'</td>';
                            }
                            ?>
                          
                            <td><?=$total;?></td>
                        </tr>
                    </tfoot>
                </table>
            </div> 
        </div>
    </div>
</div>