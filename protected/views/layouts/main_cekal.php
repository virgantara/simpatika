<?php 
$cs = Yii::app()->getClientScript();
/* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/bootstrap/css/bootstrap.min.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/jquery-ui.css"> 

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/bootstrap/js/bootstrap.min.js"></script>
	
<?php 
$cs->registerCssFile(Yii::app()->baseUrl.'/node_modules/sweetalert2/dist/sweetalert2.min.css');
$cs->registerScriptFile(Yii::app()->baseUrl.'/node_modules/sweetalert2/dist/sweetalert2.all.min.js',CClientScript::POS_END);
?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/css/main.css">   
<body>

	<nav class="navbar navbar-default navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array('class'=>'nav navbar-nav'),
	        'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),

	        // 'itemCssClass'=>'hover',
	        'encodeLabel'=>false,
			'items'=>array(
				
				array(
					'label'=>'Pencekalan <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->checkAccess([WebUser::R_SA,WebUser::R_BAAK, WebUser::R_AKPAM,WebUser::R_TAHFIDZ]),
					'itemOptions' => ['class'=>'dropdown-toggle'],
					'linkOptions' => ['class'=>'dropdown-toggle','data-toggle'=>"dropdown",'role' =>'button'],
					'items' => [
						['label'=>'AKPAM, ADM, & TAHFIDZ', 'url'=>['/pencekalan/index']],
						['label'=>'AKADEMIK', 'url'=>['/pencekalan/akademik']],
					]
				),
				
				
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array(
					'label'=>'Logout ('.Yii::app()->user->name.')',
					'url'=>['site/logout'],

					// 'encodeLabel'=>false,

					// 'template' => '<a href="{url}" id="btn-logout">{label}</a>' ,
					'linkOptions' => ['id'=>'btn-logout'],
					'visible'=>!Yii::app()->user->isGuest),


			),
		)); ?>
	</div>
	</div>
	</nav><!-- mainmenu -->
      <div class="container-fluid">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<footer class='footer-content' style="bottom: 0;">
		Head Office : Main Campus University of Darussalam Gontor Demangan Siman Ponorogo East Java Indonesia 63471<br>
Phone : (+62352) 483762, Fax : (+62352) 488182, Email : rektorat@unida.gontor.ac.id
	</footer><!-- footer -->
</div>

</body>

</html>
   