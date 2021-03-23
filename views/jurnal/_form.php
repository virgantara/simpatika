<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use common\models\JenisPublikasi;

/* @var $this yii\web\View */
/* @var $model app\models\Jurnal */
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
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Jenis Publikasi Jurnal</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                           <?= $form->field($model, 'jenis_publikasi_id',['options' => ['tag' => false]])->dropDownList(ArrayHelper::map(JenisPublikasi::find()->all(),'id','nama'),['class'=>'form-control show-tick','id'=>'luaran1','prompt'=>'- Pilih Jenis Luaran -'])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Judul Artikel</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                           <?= $form->field($model, 'judul',['options' => ['tag' => false]])->textArea(['rows'=>6])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Nama jurnal</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                           <?= $form->field($model, 'nama_jurnal',['options' => ['tag' => false]])->textInput()->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">

            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>P-ISSN</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                          <?= $form->field($model, 'pissn',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true,'required'=>'required'])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>E-ISSN</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                          <?= $form->field($model, 'eissn',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true,'required'=>'required'])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Volume</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                          <?= $form->field($model, 'volume',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true,'required'=>'required'])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Nomor</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                          <?= $form->field($model, 'nomor',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true,'required'=>'required'])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Halaman</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                          <?= $form->field($model, 'halaman',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true,'required'=>'required'])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Tahun Terbit</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                          <?= $form->field($model, 'tahun_terbit',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => '4','required'=>'required'])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Link Berkas</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                          <?= $form->field($model, 'berkas',['options' => ['tag' => false]])->textInput(['class'=>'form-control','maxlength' => true,'required'=>'required'])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Unggah Berkas</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                  <?= $form->field($model, 'path_berkas')->widget(FileInput::classname(), [
                        'options' => ['accept' => ''],
                        'pluginOptions' => [
                            'showUpload' => false,
                        ]
                    ])->label(false) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label>Sumber Dana</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                         <?= $form->field($model, 'sumber_dana',['options' => ['tag' => false]])->dropDownList(['DRPM'=>'DRPM','Non-DRPM'=>'Non-DRPM'])->label(false) ?>


                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SIMPAN</button>
            </div>
        </div>
        </div>
        <div class="col-lg-6">
            <?php 
            if(!$model->isNewRecord)
            {
                foreach($model->jurnalAuthors as $dsn)
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
   
    
    <?php ActiveForm::end(); ?>
    </div>


<?php


$jenis_luaran_wajib = !empty($model->itemLuaran) ? $model->itemLuaran->jenis_id : '';
$luaran_wajib = !empty($model->itemLuaran) ? $model->itemLuaran->jenis_id : '';
// print_r($topik_id);exit;
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