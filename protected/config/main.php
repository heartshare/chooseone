<?php
// головна конфігурація додатку
return array(
    'basePath'       => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'           => 'ChooseOne',
    'sourceLanguage' => 'en_US',
    'language'       => 'uk',
    'preload'        => array('log', 'debug'),

    // автоматично завантажуємо файли класів моделей та компонентів
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.widgets.*',
    ),

    'modules' => array(
        'gii' => array(
            'class'     => 'system.gii.GiiModule',
            'password'  => '1111',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),

    // application components
    'components' => array(
        'cache'=>array( // компонент кешування даних в Memcached
            'class'   => 'system.caching.CMemCache',
            'servers' => array(
                array('host' => 'localhost', 'port' => 11211, 'weight' => 60),
            ),
        ),
        'debug' => array(
            'class'   => 'ext.yii2-debug.Yii2Debug',
            'enabled' => true,
        ),
        'authManager' => array( // аутентифікація користувача в системі
            'class'        => 'PhpAuthManager',
            'defaultRoles' => array('guest'), // роль по замовчуванню
        ),
        'user' => array( // відображення користувача в системі
            'class'          => 'WebUser',
            'allowAutoLogin' => true, // дозволити логін через cookie
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                'index' => 'site/index',
                '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
            ),
            'showScriptName' => false,
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=chooseone',
            'emulatePrepare'   => true,
            'username'         => 'root',
            'password'         => 'root',
            'charset'          => 'utf8',
            'tablePrefix'      => 'tbl_'
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error', // вказуємо контроллер що відповідальний за відображення помилок
        ),
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'admin@mail.com',
    ),
);
