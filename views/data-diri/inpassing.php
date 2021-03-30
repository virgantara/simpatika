<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use app\models\MPangkat;


?>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                Inpassing
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pangkat/Golongan</th>
                            <th>Nomor SK</th>
                            <th>Tanggal SK</th>
                            <th>TMT</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($results as $q => $item)
                        {

                           
                        ?>
                        <tr>
                            <td><?=$q+1;?></td>
                            <td><?=$item->nama_golongan;?></td>
                            <td><?=$item->nomor_sk_inpassing;?></td>
                            <td><?=\app\helpers\MyHelper::convertTanggalIndo($item->tanggal_sk);?></td>
                            <td><?=\app\helpers\MyHelper::convertTanggalIndo($item->sk_inpassing_terhitung_mulai_tanggal);?></td>
                            <td>
                                <?php 
                                echo Html::a('View',['data-diri/inpassing-view','id'=>$item->id_riwayat_inpassing],['class'=>'btn btn-primary']);
                                ?>
                            </td>
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


<?php 

$this->registerJs(' 


', \yii\web\View::POS_READY);

?>