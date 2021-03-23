<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Dosen */

$this->title = 'Biodata Diri';
$this->params['breadcrumbs'][] = ['label' => 'Dosen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php
    if(!empty($model->dosenData->f_foto)){
                    echo "<img src='".Yii::$app->params['front']."/uploads/".$model->NIY."/".$model->dosenData->f_foto."'"."style='width:150px; height:auto;' class='img-rounded'>";
                }else{
                    echo "<img src='".Yii::$app->params['front']."/uploads/blank_foto.png'"."style='width:150px; height:auto;' class='img-rounded'>";
                }
?>
    <br><br>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dosenData.ID',
            'dosenData.NIY',
            'dosenData.nama',
            'dosenData.gender',
            'prodiDosen.nama',
            'dosenData.tempat_lahir',
            'dosenData.tanggal_lahir',
            'dosenData.status_kawin',
            'dosenData.agama',
            'dosenData.pangkat',
            'dosenData.jabatan_fungsional',
            'dosenData.perguruan_tinggi',
            'dosenData.alamat_kampus:ntext',
            'dosenData.telp_kampus',
            'dosenData.fax_kampus',
            'dosenData.alamat_rumah:ntext',
            'dosenData.telp_hp',
        ],
    ]) ?>
    
<!--    //$model->dataDosen->prodiDosen->nama;-->
    <br>
        <h1>Riwayat Pendidikan</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenPendidikan()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            'tahun_lulus',
            'jenjang',
            [
                'attribute' => 'perguruan_tinggi',
                'contentOptions' => ['style' => 'width:15%;  white-space: normal;'],
            ],
            'jurusan',
//            'f_ijazah',
            [
                'attribute'=>'f_ijazah',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_ijazah)){
            return
            Html::a('View', ['pendidikan/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['pendidikan/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['pendidikan/'.$action, 'id' => $model->ID]);
                }
            ],
            
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
        <h1>Pelatihan Profesional</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenPelatihan()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'nama_pelatihan',
                'contentOptions' => ['style' => 'width:30%;  white-space: normal;'],
            ],
            'penyelenggara',
            'tanggal_awal',
            'tanggal_akhir',
//            'f_sertifikat', 
            [
                'attribute'=>'f_sertifikat',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_sertifikat)){
            return
            Html::a('View', ['pelatihan/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['pelatihan/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['pelatihan/'.$action, 'id' => $model->ID]);
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
     <br>
        <h1>Pengalaman Mengajar</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenPengajaran()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            'program_pendidikan',
            'jurusan',
            'institusi',
            'program',
            'matkul:ntext',
            'tahun_awal',
            'tahun_akhir',
//            'f_penugasan',
            [
                'attribute'=>'f_penugasan',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_penugasan)){
            return
            Html::a('View', ['pengajaran/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['pengajaran/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
[
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['pengajaran/'.$action, 'id' => $model->ID]);
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
   
    <br>
        <h1>Produk Bahan Ajar</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenProdukajar()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            'program_pendidikan',
            [
                'attribute' => 'matkul',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'jenis',
            'tahun_awal',
            'tahun_akhir',
            'update_at',
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['produk-ajar/'.$action, 'id' => $model->ID]);
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
        <h1>Pengalaman Penelitian</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenPenelitian()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'judul',
                'contentOptions' => ['style' => 'width:30%;  white-space: normal;'],
            ],
            'tahun',
            'status',
            'sumberdana',
//            'f_penelitian',
            [
                'attribute'=>'f_penelitian',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_penelitian)){
            return
            Html::a('View', ['penelitian/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['penelitian/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['penelitian/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
     <br>
        <h1>Karya Ilmiah (Buku/Bab/Jurnal)</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenBuku()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//             'ID',
            [
                'attribute' => 'judul',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'tahun',
            [
                'attribute' => 'penerbit',
                'contentOptions' => ['style' => 'width:10%;  white-space: normal;'],
            ],
            'vol',
            'ISBN',
            [
                'attribute'=>'f_karya',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_karya)){
            return
            Html::a('View', ['buku/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['buku/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['buku/'.$action, 'id' => $model->ID]);
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
        <h1>Karya Ilmiah (Poster/Makalah)</h1>
    
     <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenMakalah()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            'judul',
            'penyelenggara',
            'tahun',
//            'f_makalah',
            [
                'attribute'=>'f_makalah',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_makalah)){
            return
            Html::a('View', ['makalah/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['makalah/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['makalah/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
    <h1>Karya Ilmiah (Penyunting/Editor/Reviewer/Resensi)</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenResensi()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'judul',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'tahun',
            'penerbit',
            'status',
//            'f_resensi',
            [
                'attribute'=>'f_resensi',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_resensi)){
            return
            Html::a('View', ['resensi/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['resensi/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['resensi/'.$action, 'id' => $model->ID]);
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
   
    <br>
    <h1>Konferensi/Lokakarya/Seminar/Simposium</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenKonferensi()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'judul',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            [
                'attribute' => 'penyelenggara',
                'contentOptions' => ['style' => 'width:15%;  white-space: normal;'],
            ],
            'tahun',
            'status_kehadiran',
//            'f_konferensi',
            [
                'attribute'=>'f_konferensi',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_konferensi)){
            return
            Html::a('View', ['konferensi/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['konferensi/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['konferensi/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
   <br>
    <h1>Kegiatan Profesional/Pengabdian Masyarakat</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenPengabdian()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'nama_kegiatan',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'bulan',
            'tahun',
            'tempat',
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['pengabdian/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
    <h1>Jabatan Dalam Pengelolaan Institusi</h1>
   
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenJabatan()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'jabatan',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'institusi',
            'tahun_awal',
            'tahun_akhir',
//            'f_penugasan',
            [
                'attribute'=>'f_penugasan',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_penugasan)){
            return
            Html::a('View', ['jabatan/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['jabatan/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'update_at',
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['jabatan/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
    <h1>Peran Dalam Kegiatan Kemahasiswaan</h1>
   
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenKegiatan()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'nama_kegiatan',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'peran',
            'tempat',
            'tahun_awal',
            'tahun_akhir',
            'update_at',
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['kegiatan/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
    <h1>Penghargaan/Piagam</h1>
       
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenPenghargaan()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'bentuk',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'pemberi',
            'tahun',
//            'f_penghargaan',
            [
                'attribute'=>'f_penghargaan',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_penghargaan)){
            return
            Html::a('View', ['penghargaan/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['penghargaan/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['penghargaan/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
    <h1>Organisasi Profesi/Ilmiah</h1>
      
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenOrganisasi()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            'NIY',
            [
                'attribute' => 'organisasi',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
            ],
            'jabatan',
            'tahun_awal',
            'tahun_akhir',
//            'f_sk',
            [
                'attribute'=>'f_sk',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->f_sk)){
            return
            Html::a('View', ['organisasi/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['organisasi/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            'update_at',
            'ver',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} ',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['organisasi/'.$action, 'id' => $model->ID]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <br>
    <h1>Assignment</h1>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query'=>$model->getDosenAssignment()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
               'header' => 'Assignment',
               'value' => 'assignmentAssign.Keterangan',
                'contentOptions' => ['style' => 'width:20%;  white-space: normal;'],
//               'filter' => Html::activeDropDownList($searchModel, 'id_assign',$assign,['class'=>'form-control','prompt' =>''])
            ],
//            'ID',
//            'NIY',
//            'assignmentData.nama',
//            [
//                'attribute'=>'namanya',
//                'value'=>'assignmentData.nama',
//            ],
//            'id_assign',
            'keterangan:ntext',
//            'status',
            [
                'attribute'=>'file',
                'format'=>'raw',
                'value' => function($data){
            if(!empty($data->file)){
            return
            Html::a('View', ['assignment/display', 'id' => $data->ID],['class' => 'btn btn-warning']).'&nbsp;&nbsp;'.
            Html::a('Download', ['assignment/download', 'id' => $data->ID],['class' => 'btn btn-primary']);
            }
            else
            {
            return
            "<p class='btn btn-danger' align='center'>No File</p>";
            }
            }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => ['Belum Diverifikasi' => 'Belum Diverivikasi', 'Sudah Diverifikasi' => 'Sudah Diverifikasi','Ditolak' => 'Ditolak']
            ],
//            'file',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} &nbsp;&nbsp;{delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['assignment/'.$action, 'id' => $model->ID]);
                }
            ],
        ],
    ]); ?>
    
</div>
