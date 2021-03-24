<?php
use app\rbac\models\AuthItem;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = Yii::t('app', 'Ganti Peran User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['change']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?= Html::encode($this->title) ?>
                </h2>
            </div>


<div class="body">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'form_validation',
        ]
    ]); ?>

        <div class="form-group form-float">
            <div class="form-line">
            <p>
                Peran
            </p>
            <?= $form->field($user, 'item_name',['options' => ['tag' => false]])->dropDownList(ArrayHelper::map(\app\rbac\models\AuthItem::find()->where(['description'=>'pegawai'])->all(),'name','name'))->label(false) ?>

            
            </div>
        </div>
               
        <?= Html::submitButton('Ganti Sekarang', ['class' => 'btn btn-primary waves-effect']) ?>
    
    <?php ActiveForm::end(); ?>

</div>

        </div>
    </div>

</div>
