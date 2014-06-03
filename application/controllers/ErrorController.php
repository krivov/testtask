<?php

class ErrorController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->errorpage = $this->view->render('error/404.phtml');
                break;
            default:
                $code = $errors->exception->getcode();
                switch ($code) {
                    case 404:
                        $this->getResponse()->setHttpResponseCode(404);
                        $this->view->errorpage = $this->view->render('error/404.phtml');
                        break;
                    case 403:
                        $this->getResponse()->setHttpResponseCode(403);
                        $this->view->errorpage = $this->view->render('error/403.phtml');
                        break;
                    case 500:
                        $this->getResponse()->setHttpResponseCode(500);
                        $this->view->errorpage = $this->view->render('error/500.phtml');
                        break;
                    case 501:
                        $this->getResponse()->setHttpResponseCode(501);
                        $this->view->errorpage = $this->view->render('error/501.phtml');
                        break;
                    default:
                        $this->getResponse()->setHttpResponseCode(500);
                        $this->view->errorpage = $this->view->render('error/500.phtml');
                        break;
                }
                break;
        }

        $this->view->exception = $errors->exception;
        $this->view->request = $errors->request;
    }
}