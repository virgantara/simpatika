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
use kartik\nav\NavX;
use yii\widgets\Menu;

AppAsset::register($this);
SweetalertAsset::register($this);

$this->title = Yii::$app->name;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Situs Resmi SIMPATIKA Universitas Darussalam (UNIDA) Gontor">
    <meta name="keywords" content="SIMPATIKA, Gontor, UNIDA Gontor">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="<?=Yii::$app->view->theme->baseUrl;?>/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?php $this->head() ?>
    <style>
      .swal2-popup {
  font-size: 1.6rem !important;
}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>    
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=Url::home();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="" alt="Logo SIMPATIKA" /></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">SIMPATIKA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?=Yii::$app->user->identity->display_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=Url::to(['user/change']);?>" class="btn btn-info btn-flat">Change Role</a>
                </div>
                <div class="pull-right">
                  <a href="<?=Url::to(['site/logout']);?>" data-method="POST" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- search form -->
      
      <?php 
    
                $menuItems = \app\helpers\MenuHelper::getMenuItems();              

                echo Menu::widget([
                    'options'=>[
                        'class'=>'sidebar-menu',
                        'data-widget' => 'tree',
                    ],
                    // 'itemOptions'=>['class'=>'treeview'],
                    
                    // 'itemCssClass'=>'hover',
                    'encodeLabels'=>false,
                    'items' => $menuItems
            ]); ?>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$this->title;?>
      </h1>
      <?php 
      echo Breadcrumbs::widget([
          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]);
      ?>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?= Alert::widget() ?>
                <?= $content ?>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2020 - <?=date('Y');?> <a href="http://pptik.unida.gontor.ac.id">UPT PPTIK Universitas Darussalam Gontor.</a></strong>
            All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
 
        <!-- /.control-sidebar-menu -->
        <div class="tab-content">
        <h3 class="control-sidebar-heading">Your Apps</h3>
        <ul class="control-sidebar-menu">
          <?php 

                  $list_apps = [];
                  try{
                      $key = Yii::$app->params['jwt_key'];
                      $session = Yii::$app->session;
                      $token = $session->get('token');
                      $decoded = \Firebase\JWT\JWT::decode($token, base64_decode(strtr($key, '-_', '+/')), ['HS256']);
                      $list_apps = $decoded->apps;
                  }

                  catch(\Exception $e)
                  {

                  }

                  foreach($list_apps as $d)
                  {
                  ?>
                   <li>
                    <a href="<?=$d->app_url.$token;?>">
                      <h4 class="control-sidebar-subheading">
                        <?=$d->app_name;?>
                      </h4>

                    </a>
                  </li>
                  
                  <?php 
                  }
                  ?>
         
          
        </ul>
        </div>
        <!-- /.control-sidebar-menu -->

      
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
