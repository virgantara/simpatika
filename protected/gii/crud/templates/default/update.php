<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
 ?>
 <?php echo "<?php\n"; ?>
<?php
echo "\$this->breadcrumbs=array(
	array('name'=>'".$this->class2name($this->modelClass)."','url'=>array('index')),
	array('name'=>'Update'),
);\n";
?>

?>



<style>
	.errorMessage, .errorSummary{
		color:red;
	}
</style>
<div class="row">
	<div class="col-xs-12">
<?php echo "<?php \$this->renderPartial('_form', [
	'model'=>\$model
]); ?>"; ?>

	</div>
</div>
