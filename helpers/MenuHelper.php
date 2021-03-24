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
		     	'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-home"></i><span>Dashboard</span>', 
		        'url' => ['site/homelog'],
		    ];

		    $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Catatan Harian</span>', 
		        'url' => ['catatan-harian/index'],
	        ];

		    $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-graduation-hat"></i><span>Pendidikan</span>', 
		        'url' => ['pendidikan/index'],
	        ];

	        $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Pengajaran</span>', 
		        'url' => ['pengajaran/index'],
	        ];

	        $menuItems[] = [
	    		'label' => '<i class="lnr lnr-rocket"></i><span>Penelitian</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_penelitian' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_penelitian">{label}</a>',
		        'items'=>[
		           	['label' => 'Usulan', 'url' => ['/lppm-penelitian/index','jenis'=>'riset']],
	                ['label' => 'Create', 'url' => ['/lppm-penelitian/create','jenis'=>'riset']]
		        ]
	        ];

	        $menuItems[] = [
	    		'label' => '<i class="lnr lnr-sun"></i><span>Pengabdian</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_abdimas' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_abdimas">{label}</a>',
		        'items'=>[
		           	['label' => 'Usulan', 'url' => ['/lppm-penelitian/index','jenis'=>'abdimas']],
	                ['label' => 'Create', 'url' => ['/lppm-penelitian/create','jenis'=>'abdimas']]
		        ]
	        ];

	        $menuItems[] = [
	    		'label' => '<i class="lnr lnr-chart-bars"></i><span>Luaran</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_luaran' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_luaran">{label}</a>',
		        'items'=>[
		           	['label' => 'Jurnal', 'url' => ['/jurnal/index']],
                    ['label' => 'Buku', 'url' => ['/buku/index']],    
                    ['label' => 'Forum Ilmiah', 'url' => ['/konferensi/index']],
                    ['label' => 'HKI', 'url' => ['/hki/index']],
                    ['label' => 'Luaran Lain', 'url' => ['/luaran-lain/index']], 
		        ]
	        ];

	        $menuItems[] = [
	    		'label' => '<i class="lnr lnr-list"></i><span>Assignment</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_assign' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_assign">{label}</a>',
		        'items'=>[
		           	['label' => 'Assignment', 'url' => ['/assign/index']],
	                ['label' => 'Files', 'url' => ['/assignment/index']],   
		        ]
	        ];

	      //   $menuItems[] = [
	    		// 'label' => '<i class="lnr lnr-users"></i><span>Account</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		     //    'url' => '#',
		     //    'submenuTemplate' => "\n<div id='pages_akun' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		     //    'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_akun">{label}</a>',
		     //    'items'=>[
		     //       	['label' => 'Change Password', 'url' => ['/site/ubah-akun']],
	      //          	['label' => 'Support', 'url' => ['/support/index']],    
		     //    ]
	      //   ];

	            
	          
		}

		else
		{
			$menuItems[] = [ 
	            ['label' => 'Home', 'url' => ['/site/index']],
	            ['label'=>'Lecturer',
	                 'items' => [
	                    ['label' => 'Search Lecturer', 'url' => ['/dosen/index']],    
	                    ['label' => 'Faculty of Ushuluddin', 'url' => ['/dosen/faculty','kategori'=>'1']],    
	                    ['label' => 'Faculty of Islamic Education', 'url' => ['/dosen/faculty','kategori'=>'2']],    
	                    ['label' => "Faculty of Shari'ah", 'url' => ['/dosen/faculty','kategori'=>'3']],    
	                    ['label' => 'Faculty of Economics and Management', 'url' => ['/dosen/faculty','kategori'=>'4']],    
	                    ['label' => 'Faculty of Humanities', 'url' => ['/dosen/faculty','kategori'=>'5']],    
	                    ['label' => 'Faculty of Science and Technology', 'url' => ['/dosen/faculty','kategori'=>'6']],    
	                    ['label' => 'Faculty of Health Science', 'url' => ['/dosen/faculty','kategori'=>'7']],    
	                            ],
	            ],

	            ['label' => 'Login', 'url' => ['/site/login']]

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