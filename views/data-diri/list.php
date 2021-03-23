<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataDiriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dosen UNIDA Gontor';
$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-diri-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--     Html::a('Create Data Diri', ['create'], ['class' => 'btn btn-success']) -->
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            'NIY',
            'NIDN',
            'nama',
            'gender',
            'namaJabfung',
            'namaPangkat',
            //'tempat_lahir',
            // 'tanggal_lahir',
            // 'status_kawin',
            // 'agama',
            // 'pangkat',
            // 'jabatan_fungsional',
            // 'perguruan_tinggi',
            // 'alamat_kampus:ntext',
            // 'telp_kampus',
            // 'fax_kampus',
            // 'alamat_rumah:ntext',
           
            [
                'header' => 'Status',
                'value' => function($model, $url){
                    return $model->status_dosen == 1 ? 'Dosen Tetap' : 'Dosen Tidak Tetap';
                }
            ],
 
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
