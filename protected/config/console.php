<?php
// конфігурація для роботи додку в консолі
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'     => 'ChooseOne console',
    'preload'  => array('log'),
    // компоненти додатку
    'components' => array(
        // конфігурація для MySQL бази данних
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=chooseone',
            'emulatePrepare'   => true,
            'username'         => 'root',
            'password'         => 'root',
            'charset'          => 'utf8',
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
);
