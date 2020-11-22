<?php


require 'vendor/autoload.php';
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
		
		if($action->id != 'loginSso')
		{
			$session = Yii::app()->session;

			if(!Yii::app()->user->isGuest)
			{

		  		if(empty($session->get('token')))
		  		{
		  			return $this->redirect(Yii::app()->params->sso_login);
		  			// return false;
		  		}

		  		else
			    	return true;
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