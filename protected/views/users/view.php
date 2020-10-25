<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	array('name'=>'Users','url'=>array('admin')),
	array('name'=>'Users'),
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>
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
		'role_id',
		'email',
		'username',
		'password_hash',
		'reset_hash',
		'last_login',
		'last_ip',
		'created_on',
		'deleted',
		'reset_by',
		'banned',
		'ban_message',
		'display_name',
		'display_name_changed',
		'timezone',
		'language',
		'active',
		'activate_hash',
		'password_iterations',
		'force_password_reset',
		'nim',
		'status_data',
		'kampus',
		'fakultas',
		'prodi',
	),
)); ?>
	</div>
</div>
