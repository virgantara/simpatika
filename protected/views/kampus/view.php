<?php
/* @var $this KampusController */
/* @var $model Kampus */

$this->breadcrumbs=array(
	array('name'=>'Kampus','url'=>array('admin')),
	array('name'=>'Kampus'),
);

$this->menu=array(
	array('label'=>'List Kampus', 'url'=>array('index')),
	array('label'=>'Create Kampus', 'url'=>array('create')),
	array('label'=>'Update Kampus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kampus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kampus', 'url'=>array('admin')),
);
?>

<h1>View Kampus #<?php echo $model->id; ?></h1>
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
		'kode_kampus',
		'nama_kampus',
	),
)); ?>
	</div>
</div>
