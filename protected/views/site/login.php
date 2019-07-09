<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
<h1>Login</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
)); ?>
<div class="login-form">
    <form action="/examples/actions/confirmation.php" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <?php echo $form->textField($model,'username',['class'=>'form-control','placeholder'=>'Username']); ?>
			<?php echo $form->error($model,'username'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->passwordField($model,'password',['class'=>'form-control','placeholder'=>'Password']); ?>
			<?php echo $form->error($model,'password'); ?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
           
    </form>
</div>

<?php $this->endWidget(); ?>

	<div class="row">
		<div class="col-xs-12  col-lg-4"></div>
		<div class="col-xs-12  col-lg-4" style="text-align: center;">
	<ul class="list-group">
		<li class="list-group-item">

		Template Jadwal silakan unduh di 
		<?php echo CHtml::link('sini',array('jadwal/template'));?>
	
</li>
<li  class="list-group-item">
		Petunjuk Unggah Jadwal silakan lihat di 
		<?php echo CHtml::link('sini',array('jadwal/petunjuk'));?>
	</li>
</ul>
</div>
<div class="col-xs-12 col-lg-4"></div>
</div><!-- form -->
