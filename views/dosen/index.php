<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal; 
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DosenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search Dosen';
?>
<div class="dosen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <?php
    if(!empty($_GET["DosenSearch"]))
    {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NIY',
//            'dosenData.nama',
            [
                'attribute'=>'namanya',
                'value'=>'dosenData.nama',
            ],
            [
                'attribute'=>'gendernya',
                'value'=>'dosenData.gender',
                'filter'=>['laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'],
            ],
            [
               'header' => 'Program Studi',
               'value' => 'prodiDosen.nama',
               'filter' => Html::activeDropDownList($searchModel, 'id_prod',$prodi,['class'=>'form-control','prompt' =>''])
            ],
//            'ID',
//            'id_prod',
//            'dosenData.gender',
//            'email:email',
//            'dosenData.alamat_rumah',
//            'dosenData.telp_hp',
            [
                'header'=>'view',
                'format'=>'raw',
                'value' => function($data){
            return
            Html::button('View Detail', ['value'=>Url::to('index.php?r=dosen%2Fdetail&id='.$data->ID),'class' => 'btn btn-primary modalButton','id'=>'']);
            }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    }
    ?>
</div>

<?php
    Modal::begin([
            'header'=>'<h4>Lecturer Detail</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
    ]);
    
        echo "<div id='modalContent' ></div>";
    Modal::end();
    ?>
