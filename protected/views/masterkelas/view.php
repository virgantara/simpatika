<?php
/* @var $this MasterkelasController */
/* @var $model Masterkelas */

$this->breadcrumbs=array(
	array('name'=>'Masterkelas','url'=>array('admin')),
	array('name'=>'Masterkelas'),
);

$this->menu=array(
	array('label'=>'List Masterkelas', 'url'=>array('index')),
	array('label'=>'Create Masterkelas', 'url'=>array('create')),
	array('label'=>'Update Masterkelas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Masterkelas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Masterkelas', 'url'=>array('admin')),
);
?>

<h1>View Masterkelas #<?php echo $model->id; ?></h1>
 <?php    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class="row">
	<div class="col-xs-12">
		
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tahun_akademik',
		'kd_kelas',
		'nama_kelas',
		'kuota',
		'keterangan',
		'id_kampus',
	),
)); ?>
	</div>
</div>
