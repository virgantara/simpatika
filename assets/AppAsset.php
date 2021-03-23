<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@klorofil';
    public $css = [
        'assets/vendor/bootstrap/css/bootstrap.min.css',
        'assets/vendor/font-awesome/css/font-awesome.min.css',
        'assets/vendor/linearicons/style.css',
        'assets/css/jquery-ui.css',
        'assets/css/source_sans_pro.css',
        'assets/css/main.css',
    ];
    public $js = [
        'assets/vendor/jquery/jquery.min.js',
        'assets/vendor/jquery-ui/jquery-ui.js',
        'assets/vendor/bootstrap/js/bootstrap.min.js',
        'assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js',
        'assets/scripts/klorofil-common.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\jui\JuiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // 'rmrevin\yii\fontawesome\CdnProAssetBundle'
    ];
}
