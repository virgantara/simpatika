<?php
/* @var $this JadwalController */
/* @var $model Jadwal */

$this->breadcrumbs=array(
	'Jadwals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Cetak Jadwal Per Dosen', 'url'=>array('cetakPerDosen')),
	array('label'=>'List Jadwal', 'url'=>array('index')),
	array('label'=>'Create Jadwal', 'url'=>array('create')),
	// array('label'=>'Template Jadwal', 'url'=>array('template')),
	array('label'=>'Upload Jadwal', 'url'=>array('uploadJadwal')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#jadwal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
	.bentrok { 
	    background-color: orange; 
	}
</style>
<h1>Manage Data Master</h1>


<?php 

    
echo '<ul>';

echo '<li>'.CHtml::link('Lampiran SK Jadwal',array('JadwalLampiranSk/admin')).'</li>';
echo '<li>'.CHtml::link('Mata Kuliah',array('Mastermatakuliah/index')).'</li>';
echo '<li>'.CHtml::link('Kelas',array('MasterKelas/admin')).'</li>';
echo '<li>'.CHtml::link('Kampus',array('Kampus/index')).'</li>';
echo '<li>'.CHtml::link('Tahun Akademik',array('Tahunakademik/index')).'</li>';
echo '<li>'.CHtml::link('Jam Mengajar',array('Jam/admin')).'</li>';
echo '<li>'.CHtml::link('User',array('user/index')).'</li>';
echo '<li>'.CHtml::link('Dosen',array('Masterdosen/admin')).'</li>';
echo '<li>'.CHtml::link('User di SIAKAD',array('users/index')).'</li>';
echo '<li>'.CHtml::link('DATAKRS di SIAKAD',array('datakrs/index')).'</li>';
echo '<li>'.CHtml::link('Upload Pembimbing Akademik',array('mastermahasiswa/uploadPA')).'</li>';

echo '</ul>';
?>

