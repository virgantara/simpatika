<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="body">

    <?= "<?php " ?>$form = ActiveForm::begin([
    	'options' => [
            'id' => 'form_validation',
    	]
    ]); ?>



<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        $tableSchema = $generator->getTableSchema();
        $column = $tableSchema->columns[$attribute];
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right"><?= Inflector::humanize($column->name);?></label>
        <div class="col-sm-9">
        <?php
        echo "    <?= " . $generator->generateActiveField($attribute). "->label(false) ?>\n\n";
         ?>
            
            </div>
        </div>
        <?php
    }
} ?>
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-primary waves-effect']) ?>
    
    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
