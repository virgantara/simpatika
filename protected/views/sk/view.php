<?php
/* @var $this SkController */
/* @var $model Sk */

$this->breadcrumbs=array(
	array('name'=>'Sk','url'=>array('admin')),
	array('name'=>'Sk'),
);

$this->menu=array(
	array('label'=>'List Sk', 'url'=>array('index')),
	array('label'=>'Create Sk', 'url'=>array('create')),
	array('label'=>'Update Sk', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sk', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sk', 'url'=>array('admin')),
);
?>

<h1>View Sk #<?php echo $model->id; ?></h1>
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
		'kode_prodi',
		'kode_fakultas',
		'nomor_sk',
		'tanggal',
		'tentang',
		'created_at',
		'updated_at',
	),
)); ?>
	</div>
</div>
