<?php

class IndexController extends Zend_Controller_Action
{

    /**
     * initialize controller
     */
    public function init()
    {
        $this->_helper->AjaxContext()
            ->addActionContext('votes', 'json')
            ->initContext('json');
    }

    /**
     * index page
     */
    public function indexAction()
    {
        $colorsMapper = new Application_Model_ColorsMapper();
        $this->view->colors = $colorsMapper->fetchAll();
    }

    /**
     * get votes for color by ajax
     */
    public function votesAction()
    {
        if ($this->_request->isXmlHttpRequest()) {
            $color = $this->_request->getParam('color');
            if ($color) {
                $votesMapper = new Application_Model_VotesMapper();
                $this->view->votes = $votesMapper->sumVotesByParam(array('color' => $color));
            }
        }
    }
}