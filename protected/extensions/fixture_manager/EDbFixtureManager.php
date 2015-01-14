<?php
/**
 * EFixtureManager
 * @author Viktor Novikov
 * @link https://github.com/NovikovViktor
 * @version 0.1
 */

/**
 * EFixtureManager represent the console command what may help you to manage your fixtures.
 * Available command properties:
 *    pathToFixtures - path to your fixtures file, default try to find in directory of console command
 *    modelsFolder - path to folder where your models classes lay, default `application.models.*1`
 *
 * You fixtures file must be like this:
 * <pre>
 * return array(
 *     'NameOfModelClass' => array(
 *          'instance1' => array(
 *              'field1' => 'value1',
 *              'field2' => 'value2',
 *              'field3' => 'value3',
 *          ),
 *     ),
 * );
 * </pre>
 * Additions:
 * 1) All attributes what you want to assign to certain model instance,
 * must be defined with `safe` validation rule;
 * 2) Don't forget configure `tablePrefix` option for `db` connection definition;
 */
class EDbFixtureManager extends CConsoleCommand
{
    public $pathToFixtures;
    public $modelsFolder;

    /**
     * Action
     */
    public function actionLoad()
    {
        // assign file variable what consist full path to fixtures file
        $file = empty($this->pathToFixtures) ? __DIR__ . '/fixtures.php' : $this->pathToFixtures;
        // import models classes to make available create new instances
        empty($this->modelsFolder) ? Yii::import('application.models.*') : Yii::import($this->modelsFolder);
        if (!file_exists($file)) { // check if exist file with fixtures
            echo "\033[33m There is no file with fixtures to load! Make sure that you create file with fixtures,
 or pass correct file name \033[0m \n";
        } else { // if exist
            $fixtures = require_once $file; // require that file with fixtures, will be array
            $errorList = null; // create array what will consist model errors
            foreach ($fixtures as $modelClass => $instances) { // run through the array with fixtures
                foreach ($instances as $key => $instance) { // go through all instances for certain model, and save it into db
                    $model = new $modelClass();
                    $model->attributes = $instances[$key];
                    if (!$model->save()) { // if model can't be saved append errors into error list array
                        $errorList[] = $model->getErrors();
                    }
                }
            }
            if (null != $errorList) { // if error list not empty
                echo "\033[33m Validation errors occurs during loading the fixtures,
 maybe some fixtures wasn't loaded to database \033[0m  \n";
                echo "\033[34m  The next errors occur \033[0m \n";
                foreach ($errorList as $key => $errors) { // run over all errors and display error what occur during saving into db
                    foreach ($errors as $k => $error) {
                        foreach ($error as $i => $value) {
                            echo "\033[31m" . $value . "\033[0m   \n"; //error
                        }
                    }
                }
            } else {
                echo "\033[37;42m All fixtures loaded properly \033[0m   \n"; // if all works fine show success message about uploaded fixtures
            }
        }
    }
}
