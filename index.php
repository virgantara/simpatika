<?php
defined('YII_DEBUG') or define('YII_DEBUG',true);

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
