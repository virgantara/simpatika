<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\LitabHki */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="body">

    <?php $form = ActiveForm::begin([
        'options' => [
            // 'id' => 'form_validation',
        ]
    ]); ?>

<?= $form->errorSummary($model,['header'=>'<div class="alert alert-danger">','footer'=>'</div>']);?>

<div class="row">
    <div class="col-lg-6">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">Jenis HKI</label>
                    <div class="form-line">
                    <?= $form->field($model, 'jenis_luaran_id',['options' => ['tag' => false]])->dropDownList(ArrayHelper::map(\common\models\JenisLuaran::find()->where(['kode'=>'LAIN'])->all(),'id','nama'),['class'=>'form-control show-tick','prompt'=>'- Pilih Jenis -'])->label(false) ?>

                    
                    </div>
                </div>
            </div>
        </div>
       
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">Judul</label>
                    <div class="form-line">
                    <?= $form->field($model, 'judul',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true,'required'=>'required'])->label(false) ?>

                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <div class="form-line">
                    <?= $form->field($model, 'deskripsi',['options' => ['tag' => false]])->textArea(['rows'=>6,'required'=>'required'])->label(false) ?>

                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">Tahun Pelaksanaan</label>
                    <div class="form-line">
                    <?= $form->field($model, 'tahun_pelaksanaan',['options' => ['tag' => false]])->textInput()->label(false) ?>

                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">Sumber Dana</label>
                    <div class="form-line">
                    <?= $form->field($model, 'sumber_dana',['options' => ['tag' => false]])->dropDownList(['DRPM'=>'DRPM','Non-DRPM'=>'Non-DRPM'])->label(false) ?>

                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">Shared link berkas</label>
                    <div class="form-line">
                    <?= $form->field($model, 'shared_link',['options' => ['tag' => false]])->textInput()->label(false) ?>

                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">Unggah Berkas</label>
                    <div class="form-line">
                    <?= $form->field($model, 'berkas')->widget(FileInput::classname(), [
                'options' => ['accept' => ''],
                'pluginOptions' => [
                    'showUpload' => false,
                ]
            ])->label(false).'NB: File format is pdf, png, jpeg, jpg and maximal sized 1 MB<br><br>' ?>
 

                    
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-lg-6">
    <?php 
    if(!$model->isNewRecord)
    {
        foreach($model->luaranLainAuthors as $dsn)
        {
    ?>
    <div class="row form-group">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label class="numbering">Author</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="input-group">
                <div class="form-line">
                    <input placeholder="Type a name of author" type="text" class="form-control date nama_author" name="authors[]" autocomplete="off" value="<?=$dsn->author->dataDiri->nama;?>"/>
                     <input type="hidden" class="nama_author_id" name="author_id[]" value="<?=$dsn->NIY;?>"/>

                </div>
                <span class="input-group-addon"><a href="javascript:void(0)" class="btn-clear"><i class="fa fa-trash"></i></a></span>
            </div>
        </div>
    </div>
    <?php
        }
    }

    else{

        
    ?>
    <div class="row form-group">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label class="numbering">Author</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="input-group">
                <div class="form-line">
                    <input placeholder="Type a name of author" type="text" class="form-control nama_author" name="authors[]" autocomplete="off" value=""/>
                     <input type="hidden" class="nama_author_id" name="author_id[]"/>

                </div>
                <span class="input-group-addon"><a href="javascript:void(0)" class="btn-clear"><i class="fa fa-trash"></i></a></span>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <div class="row clearfix">
        
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label></label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <a title="Add new author" href="javascript:void(0)" id="btn-add" class="btn btn-info"><i class="fa fa-plus"></i> Add new author</a>
        </div>
    </div>
    
    
</div>
</div>
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary waves-effect']) ?>
    
    <?php ActiveForm::end(); ?>

</div>

<?php


$this->registerJs(' 

function addAuthor(selector){
    var html = \'<div class="row form-group">\';
            html += \'<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\';
            html += \'    <label class="numbering">Author</label>\';
            html += \'</div>\';
            html += \'<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\';
                html += \'<div class="input-group">\';
                    html += \'<div class="form-line">\';
                    html += \'    <input placeholder="Type a name of author" type="text" class="form-control nama_author" name="authors[]" autocomplete="off" value=""/>\';
                   html += \'      <input type="hidden" class="nama_author_id" name="author_id[]"/>\';

                    html += \'</div>\';
                    html += \'<span class="input-group-addon"><a href="javascript:void(0)" class="btn-clear"><i class="fa fa-trash"></i> </a></span>\';
                html += \'</div>\';
                
            html += \'</div>\';
        html += \'</div>\';

        $(selector).parent().parent().before(html);
}

function authorNumbering(){
    var i = 1;
        $(\'label.numbering\').each(function(){
          $(this).html("Author " +i);
          i++;
         
        });
}


    $(document).bind("keyup.autocomplete",function(){

        $(\'.nama_author\').autocomplete({
            minLength:1,
                select:function(event, ui){
                $(this).next().val(ui.item.id);

            },
            focus: function (event, ui) {
                $(this).next().val(ui.item.id);

            },
            source:function(request, response) {
                $.ajax({
                    url: "'.Url::to(['dosen/ajax-cari-dosen']).'",
                    dataType: "json",
                    data: {
                        term: request.term,
                        
                    },
                    success: function (data) {
                        response(data);
                    }
                })
            },

        }); 
    });

    authorNumbering();
    $(document).on("click","#btn-add",function(e){
        e.preventDefault();

        addAuthor(this);

        authorNumbering();
    });

    $(document).on("click",".btn-clear",function(e){
        e.preventDefault();
        $(this).parent().parent().parent().parent().remove();
        // $(this).parent().prev().find(".nama_author_id").val("");
        // $(this).parent().prev().find(".nama_author").val("");
        authorNumbering();
    });
  
    

    ', \yii\web\View::POS_READY);

?>