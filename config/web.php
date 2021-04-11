<?php


$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'E-KHIDMAH UNIDA Gontor',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\components\Aliases'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@app/node_modules',
    ],
    'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'timeZone' => 'Asia/Jakarta',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'cache' => 'cache',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'XtdnuLJbg9w3aixeoBUDx5WKWyH1rpUs',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 7 * 24 *60 * 60, // auth expire 
            'enableSession' => true,
            'autoRenewCookie' => true,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'cookieParams' => ['lifetime' => 7 * 24 *60 * 60],
            'timeout' => 60 * 60 * 24, //session expire
            'useCookies' => true,

        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@webroot/klorofil/views'
                ],
                'baseUrl' => '@web/klorofil',
                'basePath' => '@webroot/klorofil',
            ],
        ],
        'assetManager' => [
            'assetMap' => [
                'jquery.js' => '@web/klorofil/assets/vendor/jquery/jquery.min.js',
                // 'jquery.ui.js' => '@web/themes/klorofil/js/jquery-ui.min.js',
                'bootstrap.js' => '@web/klorofil/assets/vendor/bootstrap/js/bootstrap.min.js'
            ],
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'newFileMode' => 0644,
        'newDirMode' => 0755,      
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*'],  
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'app\template\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'myCrud' => '@app/template/crud/default', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
