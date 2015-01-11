<?php
/**
 * EFixtureManager
 * @author Viktor Novikov
 * @link https://github.com/NovikovViktor
 * @version 0.1
 */

/**
 * EFixtureManager represent the console command what may help you to manage your fixtures
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
 */
class EFixtureManager extends CConsoleCommand
{
    public $pathToFixtures;

    public function actionLoad()
    {
        if (empty($this->pathToFixtures)) {
            echo "You must define path to fixtures! \n";
        }
//        Yii::import('application.models.*');
//        $user = new User();
//        var_dump($this->pathToFixtures . "/protected/extensions/fixture_manager/");die;
//        $fixtures = require_once $this->pathToFixtures;
//        foreach ($fixtures as $modelClass => $instances) {
//            foreach ($instances as $key => $instance) {
//                $model = new $modelClass();
//                $model->attributes = $instances[$key];
//                $model->save();
//            }
//        }
        echo "Fixtures load \n";
    }
}
