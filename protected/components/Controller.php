<?php


require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use GuzzleHttp\Client;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	protected function beforeAction($action)
	{
		if($action->id == 'authCallback')
		{
			return true;
		}

		else if($action->id != 'loginSso')
		{
			
			$session = Yii::app()->session;

			if(!Yii::app()->user->isGuest)
			{

		  		if(empty($session->get('token')))
		  		{
		  			$client = new Client(['base_uri' => Yii::app()->params->invoke_token_uri]);
					$response = $client->request('GET', Yii::app()->params->invoke_token_uri, [
						'headers' => [
							'x-jwt-token' => $token
						],
						'query' => [
							'uuid' => Yii::app()->user->getState('uuid')
						]
					]);
					$res = json_decode($response->getBody());
					
					if($res->code != 200)
					{
						$session->remove('token');
                    	return $this->redirect(Yii::app()->params->sso_login);
					}
					else{

						$session->add('token',$res->token);

						return true;
					}
		  			
		  		}

		  		else
		  		{
		  			// print_r(Yii::app()->user->getState('uuid'));exit;
		  			try
			        {


			            $token = $session->get('token');
			            $key = Yii::app()->params->jwt_key;
			            $decoded = JWT::decode($token, base64_decode(strtr($key, '-_', '+/')), ['HS256']);

			            $client = new Client(['base_uri' => Yii::app()->params->invoke_token_uri]);
						$response = $client->request('GET', Yii::app()->params->invoke_token_uri, [
							'headers' => [
								'x-jwt-token' => $token
							],
							'query' => [
								'uuid' => Yii::app()->user->getState('uuid')
							]
						]);
						$res = json_decode($response->getBody());
						
						if($res->code != 200)
						{
							$session->remove('token');
                        	throw new Exception;
						}
						else{

							$session->add('token',$res->token);

							return true;
						}
			        }
			        catch(Exception $e) 
			        {

			        	return $this->redirect(Yii::app()->params->sso_login);
			        }
			    	
		  		}
			}

			else
			{
				return $this->redirect(Yii::app()->params->sso_login);
				// return true;
				// return $this->redirect(['site/loginSso']);
			}
		}

		else{

			return true;
		}
	}
}