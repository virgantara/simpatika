<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\assets\SweetalertAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use kartik\nav\NavX;

AppAsset::register($this);
SweetalertAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?=Yii::getAlias('@klorofil');?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=Yii::getAlias('@klorofil');?>/assets/img/favicon.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.' '.Yii::$app->name) ?></title>

    <?php $this->head(); ?>
    <style type="text/css">
        .swal2-popup {
          font-size: 1.6rem !important;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
            <a href="<?=Url::to(['site/homelog']);?>">E-KHIDMAH</a>
        </div>
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
            </div>
            <div id="navbar-menu">
                <?php 
            
                $menuItems = \app\helpers\MenuHelper::getTopMenus();              

                   echo Menu::widget([
                    'options'=>array('class'=>'nav navbar-nav navbar-right'),
                    'itemOptions'=>array('class'=>'dropdown'),
                    
                    // 'itemCssClass'=>'hover',
                    'encodeLabels'=>false,
                    'items' => $menuItems
                ]); ?>
            </div>
        </div>
    </nav>
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <?php 
                    $menuItems = \app\helpers\MenuHelper::getMenuItems();              

                    echo Menu::widget([
                        'options'=>array('class'=>'nav'),
                        'encodeLabels'=>false,
                        'items' => $menuItems
                    ]); ?>
            </nav>
        </div>
    </div>

    <div class="main">
            <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
