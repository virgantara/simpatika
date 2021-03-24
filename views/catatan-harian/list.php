<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CatatanHarian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Catatan Harians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-header">
    <h2><?= Html::encode($this->title) ?></h2>
</div>
<div class="row">
   <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
               
            </div>

            <div class="panel-body ">
        
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Unsur</th>
                            <th>Kegiatan</th>
                            <th>Poin</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                       </tr> 
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>