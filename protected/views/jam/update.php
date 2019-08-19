 <?php
$this->breadcrumbs=array(
	array('name'=>'Jam','url'=>array('index')),
	array('name'=>'Update'),
);

?>



<style>
	.errorMessage, .errorSummary{
		color:red;
	}
</style>
<div class="row">
	<div class="col-xs-12">
<?php $this->renderPartial('_form', [
	'model'=>$model
]); ?>
	</div>
</div>
