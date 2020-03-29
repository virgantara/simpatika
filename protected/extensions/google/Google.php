<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

class Google {
	// protected $CI;
	public $clientId = '668363583558-3mj71ft76jmf1a6hfve7ann7iq2i73ei.apps.googleusercontent.com';
	public $clientSecret = 'zHlDOqsS9WXvpKaTWJodHIjF';
	public $redirectURI = 'http://local.simjad.com/index.php?r=site/oauth2callback';
	// public $client = null;
	
	public function __construct(){

        $this->client = new Google_Client();
		$this->client->setClientId($this->clientId);
		$this->client->setClientSecret($this->clientSecret);
		// print_r($this->redirectURI);exit;
		$this->client->setRedirectUri($this->redirectURI);
		$this->client->setScopes(array(
			"https://www.googleapis.com/auth/plus.login",
			// "https://www.googleapis.com/auth/plus.me",
			"https://www.googleapis.com/auth/userinfo.email",
			"https://www.googleapis.com/auth/userinfo.profile"
			)
		);
  	
  		$this->google_oauthV2 = new Google_Service_Oauth2($this->client);

	}

	public function get_login_url(){
		return  $this->client->createAuthUrl();

	}

	public function validate(){		
		if (isset($_GET['code'])) {
		  $this->client->authenticate($_GET['code']);
		  Yii::app()->session['access_token'] = $this->client->getAccessToken();

		}
		if (isset(Yii::app()->session['access_token']) && Yii::app()->session['access_token']) {
		  	$this->client->setAccessToken(Yii::app()->session['access_token']);
		  	$gpUserProfile = $this->google_oauthV2->userinfo->get();
		   
		
			$person = $gpUserProfile;
			
			$info['id']=$person->id;
			$info['email']=$person->email;
			$info['name']=$person->name;
			// $info['link']=$person['url'];
			$info['profile_pic']=$person->picture;
			// print_r($info);exit;
		   	return  $info;
		}


	}

}