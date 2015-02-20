<?php
$_SERVER['SCRIPT_FILENAME'] = dirname(__FILE__) . '/../../index-test.php';
$_SERVER['SCRIPT_NAME'] = basename($_SERVER['SCRIPT_FILENAME']);

// change the following paths if necessary
$yiit = dirname(__FILE__) . '/../../vendor/yiisoft/yii/framework/yiit.php';
$config = dirname(__FILE__) . '/../config/test.php';
require_once($yiit);
require_once(dirname(__FILE__) . '/WebTestCase.php');
Yii::createWebApplication($config);
