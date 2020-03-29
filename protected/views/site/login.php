
<style type="text/css">
    

.google-button {
  height: 40px;
  border-width: 0;
  background: white;
  color: #737373;
  border-radius: 5px;
  white-space: nowrap;
  box-shadow: 1px 1px 0px 1px rgba(0,0,0,0.05);
  transition-property: background-color, box-shadow;
  transition-duration: 150ms;
  transition-timing-function: ease-in-out;
  padding: 0;
  
  
}

.google-button:hover{
    box-shadow: 1px 4px 5px 1px rgba(0,0,0,0.1);
}

.google-button:focus{
    box-shadow: 1px 4px 5px 1px rgba(0,0,0,0.1);
}

.google-button:active{
    background-color: #e5e5e5;
    box-shadow: none;
    /*transition-duration: 10ms;*/
}
    
.google-button__icon {
  display: inline-block;
  vertical-align: middle;
  margin: 8px 0 8px 8px;
  width: 18px;
  height: 18px;
  box-sizing: border-box;
}

.google-button__icon--plus {
  width: 27px;
}

.google-button__text {
  display: inline-block;
  vertical-align: middle;
  padding: 0 24px;
  font-size: 14px;
  font-weight: bold;
  font-family: 'Roboto',arial,sans-serif;
}

</style>

<div class="main-content">
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
            <div class="center">
                <h1>
                    <i class="ace-icon fa fa-leaf green"></i>
                    <span class="red">Simpatika</span>
                    <span class="white" id="id-text2">Application</span>
                </h1>
                <h4 class="grey" id="id-company-text">&copy; Universitas Darussalam Gontor</h4>
            </div>

            <div class="space-6"></div>

            <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header blue lighter bigger">
                                <i class="ace-icon fa fa-coffee green"></i>
                                Please Enter Your Information
                            </h4>

                            <div class="space-6"></div>

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
    <fieldset>
        <div id="info" style="display: none"></div>
        <label class="block clearfix">
            <span class="block input-icon input-icon-right">
               <?php echo $form->textField($model,'username',['class'=>'form-control','placeholder'=>'Username']); ?>
<?php echo $form->error($model,'username'); ?>
                <i class="ace-icon fa fa-user"></i>
            </span>
        </label>

        <label class="block clearfix">
            <span class="block input-icon input-icon-right">
              <?php echo $form->passwordField($model,'password',['class'=>'form-control','placeholder'=>'Password']); ?>
<?php echo $form->error($model,'password'); ?>
                <i class="ace-icon fa fa-lock"></i>
            </span>
        </label>

        <div class="space"></div>

        <div class="clearfix">
            
            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                <i class="ace-icon fa fa-key"></i>
                <span class="bigger-110">Login</span>
            </button>
        </div>

        <div class="space-4"></div>
    </fieldset>

<?php $this->endWidget(); ?>
<div class="social-or-login center">
    <span class="bigger-110">Or Login Using</span>
</div>

<div class="space-6"></div>
<!-- 
<div class="social-login center">
  <a href="" class="google-button">
  <span class="google-button__icon">
    <svg viewBox="0 0 366 372" xmlns="http://www.w3.org/2000/svg"><path d="M125.9 10.2c40.2-13.9 85.3-13.6 125.3 1.1 22.2 8.2 42.5 21 59.9 37.1-5.8 6.3-12.1 12.2-18.1 18.3l-34.2 34.2c-11.3-10.8-25.1-19-40.1-23.6-17.6-5.3-36.6-6.1-54.6-2.2-21 4.5-40.5 15.5-55.6 30.9-12.2 12.3-21.4 27.5-27 43.9-20.3-15.8-40.6-31.5-61-47.3 21.5-43 60.1-76.9 105.4-92.4z" id="Shape" fill="#EA4335"/><path d="M20.6 102.4c20.3 15.8 40.6 31.5 61 47.3-8 23.3-8 49.2 0 72.4-20.3 15.8-40.6 31.6-60.9 47.3C1.9 232.7-3.8 189.6 4.4 149.2c3.3-16.2 8.7-32 16.2-46.8z" id="Shape" fill="#FBBC05"/><path d="M361.7 151.1c5.8 32.7 4.5 66.8-4.7 98.8-8.5 29.3-24.6 56.5-47.1 77.2l-59.1-45.9c19.5-13.1 33.3-34.3 37.2-57.5H186.6c.1-24.2.1-48.4.1-72.6h175z" id="Shape" fill="#4285F4"/><path d="M81.4 222.2c7.8 22.9 22.8 43.2 42.6 57.1 12.4 8.7 26.6 14.9 41.4 17.9 14.6 3 29.7 2.6 44.4.1 14.6-2.6 28.7-7.9 41-16.2l59.1 45.9c-21.3 19.7-48 33.1-76.2 39.6-31.2 7.1-64.2 7.3-95.2-1-24.6-6.5-47.7-18.2-67.6-34.1-20.9-16.6-38.3-38-50.4-62 20.3-15.7 40.6-31.5 60.9-47.3z" fill="#34A853"/></svg>
  </span>
  <span class="google-button__text">Sign in with Google</span>

</a>
</div> -->
</div><!-- /.widget-main -->


</div><!-- /.widget-body -->
</div><!-- /.login-box -->



</div><!-- /.position-relative -->


</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.main-content -->