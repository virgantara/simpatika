<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Nenad Zivkovic <nenad@freetuts.org>
 * 
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'bower_components/font-awesome/css/font-awesome.min.css',
        'bower_components/Ionicons/css/ionicons.min.css',
        'bower_components/jquery-ui/themes/base/jquery-ui.min.css',
        'css/AdminLTE.min.css',
        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'css/skins/_all-skins.min.css',
        // 'plugins/bootstrap/css/bootstrap.min.css',
        // 'plugins/node-waves/waves.css',
        // 'plugins/animate-css/animate.css',
        // 'plugins/sweetalert/sweetalert.css',
        // 'plugins/bootstrap-select/css/bootstrap-select.css',
        // 'css/style.css',
        // 'css/themes/all-themes.css',
        // 'plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        // 'plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
        // 'plugins/jquery-ui/jquery-ui.css'
    ];

    public $js = [
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/jquery-ui/jquery-ui.min.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
        'bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'bower_components/fastclick/lib/fastclick.js',
        'js/adminlte.min.js',
        // 'plugins/bootstrap/js/bootstrap.js',
        // 'plugins/bootstrap-select/js/bootstrap-select.js',
        // 'plugins/jquery-slimscroll/jquery.slimscroll.js',
        // 'plugins/node-waves/waves.js',
        // 'plugins/sweetalert/sweetalert.min.js',
        // 'plugins/jquery-validation/jquery.validate.js',
        // 'js/admin.js',
        // 'js/demo.js',
        // 'js/pages/forms/form-validation.js',
        // 'plugins/bootstrap-select/js/bootstrap-select.js',
        // 'plugins/autosize/autosize.js',
        // 'plugins/momentjs/moment.js',
        // 'plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
        // 'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
        // 'js/pages/forms/basic-form-elements.js',
        // 'plugins/jquery-ui/jquery-ui.js'
        // 'js/pages/examples/sign-in.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',

    ];
}
