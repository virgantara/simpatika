<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DataDiriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Diri';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-diri-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Data Diri', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'NIY',
            'NIDN',
            'nama',
            'gender',
            'tempat_lahir',
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
            // 'telp_hp',
            // 'f_foto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
