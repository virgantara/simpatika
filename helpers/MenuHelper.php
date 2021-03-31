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
		        'url' => ['site/index'],
		    ];

		    $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-user"></i><span>Profil</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_profil' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_profil">{label}</a>',
		        'items'=>[
		           	['label' => 'Data Pribadi', 'url' => ['/data-diri/create']],
	                ['label' => 'Inpassing', 'url' => ['/data-diri/inpassing']],
	                ['label' => 'Jabatan Fungsional', 'url' => ['/data-diri/jabfung']],
	                ['label' => 'Kepangkatan', 'url' => ['/data-diri/pangkat']],
	                ['label' => 'Penempatan', 'url' => ['/data-diri/penempatan']],
		        ]
	        ];

		    $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Catatan Harian</span>', 
		        'url' => ['catatan-harian/index'],
	        ];

	        $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Unit Kerja</span>', 
		        'url' => ['jabatan/list'],
		        'visible' => Yii::$app->user->can('pimpinan')
	        ];

		    $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-graduation-hat"></i><span>Kualifikasi</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_kualifikasi' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_kualifikasi">{label}</a>',
		        'items'=>[
		           	['label' => 'Pendidikan Formal', 'url' => ['/pendidikan/index']],
	                ['label' => 'Diklat', 'url' => ['/pelatihan/index']]
		        ]
	        ];

	        $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Pelaks. Pendidikan</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_pendidikan' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_pendidikan">{label}</a>',
		        'items'=>[
		           	['label' => 'Pengajaran', 'url' => ['/pengajaran/index']],
		           	['label' => 'Bimbingan Mahasiswa', 'url' => ['/bimbingan-mahasiswa/index']],
		           	['label' => 'Pengujian Mahasiswa', 'url' => ['/pengajaran/index']],
		           	['label' => 'Bahan Ajar', 'url' => ['/produk-ajar/index']],
		           	['label' => 'Orasi ilmiah', 'url' => ['/konferensi/index']],
		           	['label' => 'Tugas Tambahan', 'url' => ['/jabatan/index']],
		        ]
	        ];

	        
	       	$menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Pelaks. Penelitian</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_penelitian' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_penelitian">{label}</a>',
		        'items'=>[
		           	['label' => 'Penelitian', 'url' => ['/penelitian/index']],
		           	['label' => 'Publikasi karya', 'url' => ['/publikasi/index']],
		           	['label' => 'Paten/HKI', 'url' => ['/hki/index']],
		           	
		        ]
	        ];

	        $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Pelaks. Pengabdian</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_pengabdian' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_pengabdian">{label}</a>',
		        'items'=>[
		           	['label' => 'Pengabdian', 'url' => ['/pengabdian/index']],
		           	['label' => 'Pembicara', 'url' => ['/pembicara/index']],
		           	['label' => 'Jabatan Struktural', 'url' => ['/organisasi/index']],
		        ]
	        ];

	        $menuItems[] = [
	    		'template' => '<a href="{url}">{label}</a>',
		        'label' => '<i class="lnr lnr-book"></i><span>Penunjang</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_penunjang' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_penunjang">{label}</a>',
		        'items'=>[
		           	['label' => 'Anggota Profesi', 'url' => ['/organisasi/index']],
		           	['label' => 'Pengelola jurnal', 'url' => ['/pengajaran/index']],
		           	['label' => 'Penghargaan', 'url' => ['/organisasi/index']],
		           	['label' => 'Visiting Scientist', 'url' => ['/organisasi/index']],
		           	['label' => 'Penunjang lain', 'url' => ['/organisasi/index']],
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
	    		'label' => '<i class="lnr lnr-list"></i><span>Layanan BKD</span><i class="icon-submenu lnr lnr-chevron-left"></i>', 
		        'url' => '#',
		        'submenuTemplate' => "\n<div id='pages_bkd' class='collapse'><ul class='nav'>\n{items}\n</ul></div>\n",
		        'template' => '<a class="collapsed" data-toggle="collapse" href="#pages_bkd">{label}</a>',
		        'items'=>[
		           	['label' => 'Klaim Kegiatan', 'url' => ['/bkd/klaim']],
		           	['label' => 'BKD Saya', 'url' => ['/bkd/index']],   
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