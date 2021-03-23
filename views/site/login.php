<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

//$img= Url::to("frontend/web/Images/logo_kamp.png");
// $BaseUrl=Yii::$app->urlManager->baseUrl."/Images/logo_kamp.png";

//$img= Url::to(Yii::getAlias('@frontend')."/web/Images/logo_kamp.png");
//Yii::setAlias('@logo_unida',$img);
$img = Yii::$app->params['front'].'/Images/logo_kamp.png';
//print_r(Yii::getAlias('@logo_unida'));exit;
?>


<div class="site-login">
    <div class="row col-lg-4" >&nbsp;</div>
    <div class="row col-lg-4" style="text-align:center">
        
        <div class="col-lg-12" >
            
<!--        <p>Please fill out the following fields to login:</p>-->
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'NIY')->textInput(['autofocus' => true, 'placeholder' => 'Username', 'style' => 'height:40px;']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password', 'style' => 'height:40px;']) ?>

                 <div class="form-group pull-right" style='padding-right:91px;'>
                    <p>
                    <?= Html::submitButton("Login", ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </p>
                    or
                    <p>
                    <a href="<?=\yii\helpers\Url::to(['/site/auth','authclient'=>'google']);?>" class="btn btn-default">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg"  height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg> Sign in using Google+
                    </a>
                </p>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row col-lg-4" >&nbsp;</div>
   
</div>
