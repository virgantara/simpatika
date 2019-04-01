<?php
/* @var $this JadwalLampiranSkController */
/* @var $model JadwalLampiranSk */

$this->breadcrumbs=array(
	'Jadwal Lampiran Sks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List JadwalLampiranSk', 'url'=>array('index')),
	array('label'=>'Create JadwalLampiranSk', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#jadwal-lampiran-sk-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jadwal Lampiran Sks</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'jadwal-lampiran-sk-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nomor_sk',
		'tanggal_sk',
		'tentang',
		'tanggal_penetapan',
		'bunyi_lampiran',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
