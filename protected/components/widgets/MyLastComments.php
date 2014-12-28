<?php

/**
 * Віджет що робить вибірку та відображає останні коментарі(по замовчуванню 3)
 */
class MyLastComments extends CWidget
{
    public $view = 'default';
    public $limit = 3;

    /**
     * При підключенні віджета виконається дана функція
     */
    public function run()
    {
        $comments = Comments::model()->findAll(array(
            'order' => 'id DESC',
            'limit' => $this->limit,
        ));

        $this->render('MyLastComments/' . $this->view, array('comments' => $comments));
    }
}
