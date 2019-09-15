<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/asset/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>asset/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<meta name="google-signin-client_id" content="668363583558-roc29ghfv67444rmi9sp1fvovpe68kn5.apps.googleusercontent.com">
		
		
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

<body class="login-layout blur-login"  style="background:url('<?=Yii::app()->baseUrl;?>/images/bg.jpg');background-repeat: no-repeat;background-size: cover">
		

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<div class="main-container">
		<?=$content;?>
		</div><!-- /.main-container -->

<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
<script type="text/javascript">
    

    function onLoad() {
    	renderButton();
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }

    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSignIn,
        'onfailure': onFailure
      });
    }

    // function onSuccess(googleUser) {
    //   console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    // }
    function onFailure(error) {
      console.log(error);
    }

	
	function onSignIn(googleUser) {
      	
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        // console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        // console.log('Full Name: ' + profile.getName());
        // console.log('Given Name: ' + profile.getGivenName());
        // console.log('Family Name: ' + profile.getFamilyName());
        // console.log("Image URL: " + profile.getImageUrl());
     
        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        // console.log("ID Token: " + id_token);
        var auth2 = gapi.auth2.getAuthInstance();
        $.ajax({
            type : "POST",
            url : "<?=Yii::app()->createUrl('/site/loginGoogle');?>",
            data : "email="+profile.getEmail(),
            error : function(e){
            	console.log(e.responseText);
            	
                auth2.signOut();
            },
            success : function(data){
                var hasil = $.parseJSON(data);
                // console.log(data);
                 // auth2.signOut();
                if(hasil.code == '200'){
                	window.location = '<?=Yii::app()->createAbsoluteUrl('site/index');?>';

                }

                else{
                    auth2.signOut();
                    // alert(hasil.message);
                    $('#info').show();
                    $('#info').html('<div class="alert alert-'+hasil.short+'">'+hasil.message+'</div>');
                }
                // console.log(data);
            }
        });

 	}

    </script>}

	</body>

</html>
