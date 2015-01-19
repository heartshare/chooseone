<?php
/**
 * EDbFixtureManager
 * @author Viktor Novikov <viktor.novikov95@gmail.com>
 * @link https://github.com/NovikovViktor
 * @version 1.0
 */

/**
 * EDbFixtureManager represent the console command what may help you to manage your fixtures.
 * Available command properties:
 *    pathToFixtures - path to your fixtures file, default try to find in directory of console command
 *    modelsFolder - path to folder where your models classes lay, default `application.models.*1`
 *
 * You fixtures file must be like this:
 * <pre>
 * return array(
 *     'NameOfModelClass' => array(8
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
     * Load fixtures into database from fixtures file
     */
    public function actionLoad()
    {
        echo "\033[36m Are you sure you want to load fixtures? Your database will be purged! [Y/N] \033[0m";
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        $purgedLine = preg_replace('/[^A-Za-z0-9\-]/', '', $line); // or trim($line)
        if (strtolower($purgedLine) == 'n') {
            echo "\033[34m Stopping the executing... Done. \033[0m \n";
            exit(0);
        }
        // assign file variable what consist full path to fixtures file
        $file = empty($this->pathToFixtures) ? __DIR__ . '/fixtures.php' : $this->pathToFixtures;
        // import models classes to make available create new instances
        if (empty($this->modelsFolder)) { // if property empty default load form the models folder in protected directory
            Yii::import('application.models.*');
        } else {
            if (is_array($this->modelsFolder)) { // if modelsFolder defined check if it array of models
                foreach ($this->modelsFolder as $key => $folder) {
                    Yii::import($folder); //import each folder form array
                }
            } else {
                Yii::import($this->modelsFolder); //import single models folder
            }
        }
        if (!file_exists($file)) { // check if exist file with fixtures
            echo "\033[33m There is no file with fixtures to load! Make sure that you create file with fixtures,
 or pass correct file name \033[0m \n";
        } else { // if exist
            $fixtures = require_once $file; // require that file with fixtures, will be array
            $errorList = array(); // create array what will consist model errors
            foreach ($fixtures as $modelClass => $instances) { // run through the array with fixtures
                $modelClass::model()->deleteAll(); // removing old rows from database
                foreach ($instances as $key => $instance) { // go through all instances for certain model, and save it into db
                    $model = new $modelClass();
                    $model->attributes = $instances[$key];
                    if (! $model->save()) { // if model can't be saved append errors into error list array
                        $errorList[] = $model->getErrors();
                    }
                }
            }
            if (!empty($errorList)) { // if error list not empty
                echo "\033[31m Validation errors occurs during loading the fixtures,
 some fixtures wasn't loaded to database \033[0m  \n";
                echo "\033[33m  The next errors occur \033[0m \n";
                foreach ($errorList as $key => $errors) { // run over all errors and display error what occur during saving into db
                    foreach ($errors as $k => $error) {
                        foreach ($error as $i => $value) {
                            echo "\033[37;41m" . $value . "\033[0m   \n"; //display error
                        }
                    }
                }
            } else {
                echo "\033[37;42m All fixtures loaded properly \033[0m   \n"; // if all works fine show success message about uploaded fixtures
            }
        }
    }

    /**
     * Show a some info about `fixtures` command
     *
     * @return string
     */
    public function getHelp()
    {
        $output = "\033[34m This command will allow you to manage your fixtures in a simple way.
 Be careful all rows from database will be removed! \033[0m \n\n";

        return $output . parent::getHelp();
    }
}
