<?php
/* @var $this PencekalanController */
/* @var $model Pencekalan */

$this->breadcrumbs=array(
	array('name'=>'Pencekalan','url'=>array('admin')),
	array('name'=>'Pencekalan'),
);

$this->menu=array(
	array('label'=>'List Pencekalan', 'url'=>array('index')),
	array('label'=>'Create Pencekalan', 'url'=>array('create')),
	array('label'=>'Update Pencekalan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pencekalan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pencekalan', 'url'=>array('admin')),
);
?>

<h1>View Pencekalan #<?php echo $model->id; ?></h1>
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
		'tahun_id',
		'nim',
		'tahfidz',
		'adm',
		'akpam',
		'akademik',
		'created_at',
		'updated_at',
	),
)); ?>
	</div>
</div>
