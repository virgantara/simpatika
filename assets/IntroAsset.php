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
class IntroAsset extends AssetBundle
{
	public $sourcePath = '@npm/intro.js/';
    // public $baseUrl = '@themes';

    public $css = [
        'minified/introjs.min.css',
        // 'themes/introjs-modern.css'
    ];

    public $js = [
        'minified/intro.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',

    ];

}