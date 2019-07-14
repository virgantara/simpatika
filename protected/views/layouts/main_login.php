<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/asset/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>asset/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/asset/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/asset/assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>asset/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/asset/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>asset/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?=Yii::app()->baseUrl;?>asset/js/html5shiv.min.js"></script>
		<script src="<?=Yii::app()->baseUrl;?>asset/js/respond.min.js"></script>
		<![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="login-layout blur-login" style="background:url('<?=Yii::app()->baseUrl;?>/images/bg.jpg');background-repeat: no-repeat;background-size: cover">
		

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<div class="main-container">
		<?=$content;?>
		</div><!-- /.main-container -->
	</body>
</html>
