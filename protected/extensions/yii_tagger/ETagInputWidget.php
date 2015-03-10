<?php
/**
 * ETagInputWidget
 * @author Viktor Novikov <viktor.novikov95@gmail.com>
 * @link https://github.com/NovikovViktor
 * @version 1.0.0
 */

/**
 * Widget for make user friendly tag input field
 */
class ETagInputWidget extends CInputWidget
{
    public $model;
    public $attribute;
    public $multiple = true;

    public function run()
    {
        $results = array();
        $models = $this->model->findAll();
        foreach ($models as $key => $model) {
            $fieldName = $this->attribute;
            $results[] = $model->$fieldName;
        }
//        var_dump($results);die;

        $this->render('field', array(
            'results'   => $results,
            'attribute' => $this->attribute,
            'multiple'  => $this->multiple,
        ));
    }
}
