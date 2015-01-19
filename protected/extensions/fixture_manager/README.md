EDbFixtureManager
==================================
EDbFixtureManager - is simple tool for manage and use fixtures with Yii framework.

Basic usage:
1) Download the extension and place it in `extensions` directory;

2) Create file called fixtures.php, with content, what will be looks like this:
``` php
<?php
return array(
    'ModelClassName' => array(
        'modelInstanceId' => array(
            'field1' => 'value1',
            'field2' => 'value2',
            ...
        ),
        ...
    ),
    ...
);
```
NOTE. The fields that you want to assign to the model instance,
need to be defined with `safe` validator in `rules()` method of the model!

3) Make sure that you configure database config for console application:
Add the following code to your console config:
``` php
...
'commandMap' => array(
        'fixtures' => array(
            'class'          => 'ext.fixture_manager.EDbFixtureManager', // import class of console command
            'pathToFixtures' => '/var/www/chooseone/protected/extensions/fixture_manager/fixtures.php', // pass the path to your fixtures file
            'modelsFolder'   => 'application.models.*', // specify the folder where your models classes lays
        ),
),
...
```

NOTE. If you you have a module architecture and your models lays in multiple folder you can specify `modelsFolder` as array.
E.g. ` 'modelsFolder'   => array('application.models.*', 'application.modules.user.models.*') ,`

4) Run in cli: `php path/to/yiic fixtures load` ;

TO DO
===============
1) Add truncate mode when upload fixtures
2) Add relation support
