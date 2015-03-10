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

    public function run()
    {
        $results = array();
        $models = $this->model->findAll();
        foreach ($models as $key => $model) {
            $results[] = $this->attribute;
        }

        $this->render('field', array('model' => $this->model, 'attribute' => $this->attribute));
    }
}
