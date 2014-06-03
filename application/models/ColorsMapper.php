<?php

class Application_Model_ColorsMapper extends Application_Model_TableMapper
{
    /**
     *
     */
    public function __construct()
    {
        $this->setDbTable('Application_Model_DbTable_Colors');
    }

    /**
     * Creates new model object.
     *
     * @return  Application_Model_Base
     */
    public function createModel()
    {
        return new Application_Model_Colors();
    }
}