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

<div class="social-login center">
   <div id="my-signin2"></div>
</div>
</div><!-- /.widget-main -->


</div><!-- /.widget-body -->
</div><!-- /.login-box -->



</div><!-- /.position-relative -->


</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.main-content -->