<?php
namespace app\helpers;

use Yii;
use yii\helpers\Url;
/**
 * Css helper class.
 */
class MenuHelper
{
    public static function getMenuItems()
    {

    	// $userRole = Yii::$app->user->identity->access_role;
        $menuItems = [];

        // $currentRoute = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
		if(!Yii::$app->user->isGuest)
		{
			$menuItems[] = [
		        'label' => 'Beranda', 
		        'template' => '<a href="{url}" ><i class="fa fa-home"></i><span>{label}</span></a>',
		        'url' => ['site/index']
		    ];

		    $menuItems[] = [
	    		'label' => 'Jadwal', 
	        	'template' => '<a href="#" ><i class="fa fa-book"></i> <span>{label}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>',
	        	'options' => ['class' => 'treeview'],
	        	'url' => '#',
		        'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
		        'items'=>[
	           	
		           	[
		            	'label' => '<i class="fa fa-circle-o "></i> Manage',  
		            	'template' => '<a href="{url}" >{label}</a>',
		                'url' => ['/simak-jadwal-temp/index'],	      
		               
		            ],
		            [
		            	'label' => '<i class="fa fa-circle-o "></i> Monitor',  
		            	'template' => '<a href="{url}" >{label}</a>',
		                'url' => ['/pengabdian/index'],	        
		            ],
		            [
		            	'label' => '<i class="fa fa-circle-o "></i> Personal',  
		            	'template' => '<a href="{url}" >{label}</a>',
		                'url' => ['/pengabdian/index'],	        
		            ],
	        	]
	        ];
	        


	            
	          
		}




		return $menuItems;
    }

    public static function getTopMenus()
    {
    	$menuItems = [];
    	$list_apps = [];
    	if(!Yii::$app->user->isGuest)
    	{
	    	$key = Yii::$app->params['jwt_key'];
	    	$session = Yii::$app->session;
	    	if($session->has('token'))
	    	{
		    	$token = $session->get('token');
		    	try
            	{
		        	$decoded = \Firebase\JWT\JWT::decode($token, base64_decode(strtr($key, '-_', '+/')), ['HS256']);
		        	foreach($decoded->apps as $d)
			        {
			        	$list_apps[] = [
			        		'template' => '<a target="_blank" href="{url}">{label}</a>',
			        		'label' => $d->app_name,
			        		'url' => $d->app_url.$token
			        	];
			        }
		        }
	        	catch(\Exception $e) 
	            {
	                // return Yii::$app->response->redirect(Yii::$app->params['sso_login']);
	            }
	        

		        
		    }
        }
    	if(!Yii::$app->user->isGuest){	
			
    		$class = Yii::$app->user->identity->class ?: '';
    		$stars = Yii::$app->user->identity->stars ?: '';
    		$label_stars = '';
    		for($i=0;$i<$stars;$i++){
    			$label_stars .= '<i class="lnr lnr-star"></i>';
    		}
    		$menuItems[] = [
		     	'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">'.$label_stars.' <span class="badge bg-success">'.$class.'</span></a>',
		        'label' => ''
		        
		    ];

    		 $menuItems[] = [
		     	'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-layers"></i> <span>{label}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>',
		        'label' => 'Your apps', 
		        'submenuTemplate' => "\n<ul class='dropdown-menu'>\n{items}\n</ul>\n",
	         	'items' => $list_apps
		        
		    ];

		    $menuItems[] = [
		     	'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-user"></i> <span>{label}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>',
		        'label' => Yii::$app->user->identity->email, 
		        'submenuTemplate' => "\n<ul class='dropdown-menu'>\n{items}\n</ul>\n",
	         	'items' => [
	         		[
	         			'template' => '<a href="{url}">{label}</a>',
		        		'label' => 'My Profile', 
	         			'url' => ['data-diri/create']
	         		],
	         		[
	         			'template' => '<a href="{url}">{label}</a>',
		        		'label' => 'Change Role', 
	         			'url' => ['site/change']
	         		],
	         		[
	         			'template' => '<a href="{url}" data-method="POST">{label}</a>',
		        		'label' => 'Sign Out', 
	         			'url' => ['site/logout']
	         		]
	         	]
		        
		    ];
		}


    	return $menuItems;
    }

    public static function getUserMenus()
    {
    	$menuItems = [];

    	if(!Yii::$app->user->isGuest){

	
			$menuItems[] = [
		     	'template' => '<a data-widget="pushmenu" href="{url}" role="button" class="nav-link">{label}</a>',
		        'label' => '<i class="fas fa-bars"></i>', 
		        'url' => '#'
		    ];
		   

		}


    	return $menuItems;
    }
}