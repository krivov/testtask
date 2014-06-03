<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        $colorsMapper = new Application_Model_ColorsMapper();
        $this->view->colors = $colorsMapper->fetchAll();
    }
}