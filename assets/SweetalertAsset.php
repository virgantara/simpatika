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
class SweetalertAsset extends AssetBundle
{
	public $sourcePath = '@npm/sweetalert2/dist/';
    // public $baseUrl = '@themes';

    public $css = [
        'sweetalert2.min.css'
    ];

    public $js = [
        'sweetalert2.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',

    ];

}