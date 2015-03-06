[![Project Status](https://stillmaintained.com/NovikovViktor/chooseone.png)](https://stillmaintained.com/NovikovViktor/chooseone)
[![Build Status](https://travis-ci.org/NovikovViktor/chooseone.svg?branch=dev)](https://travis-ci.org/NovikovViktor/chooseone)

Chooseone
========================

Welcome to Chooseone - a project based on Yii.

This document contains information on how to download, install, and run
OnTheWay project.

1) Installing the project
----------------------------------

Clone repository to your local machine, using command:

``` bash
    git clone git@github.com:NovikovViktor/chooseone.git (SSH)
```

2) Get dependencies using composer
-------------------------------------

``` bash
    php composer.phar install(update)
```

3) Create database named 'chooseone'(you can assign any name what you like,
but then do not forget to change name in config file)

4) Change your permissions, create schema, load fixtures using commands below
--------------------------------

``` bash
    sudo chmod -R 777 /path/to/project
    php protected/yiic migrate
    php protected/yiic fixtures load [--truncateMode=]
```

6) Create some folders if they don't exist.

7) Create virtual host and then restart Apache2 (or nginx, or any server what you use)

Simple config for apache:
```
    <VirtualHost *:80>
        DocumentRoot /var/www/chooseone/
        ServerName chooseone
        <Directory /var/www/chooseone/>
            Options FollowSymLinks
            AllowOverride All
        </Directory>
    </VirtualHost>
```

8) Run application in browser
-------------------------------
    http://chooseone/
