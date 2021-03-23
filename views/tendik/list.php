<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TendikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenaga Kependidikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tendik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
            'NIY',
            'nama',
            'gender',
            'tempat_lahir',
            'namaJenjang',
            'namaJenis',
            //'tanggal_lahir',
            //'status_kawin',
            //'agama',
            //'pangkat',
            //'jenjang_kode',
            //'perguruan_tinggi',
            //'alamat_kampus:ntext',
            //'telp_kampus',
            //'fax_kampus',
            //'alamat_rumah:ntext',
            //'telp_hp',
            //'unit_id',
            //'jabatan_id',

           
        ],
    ]); ?>
</div>
