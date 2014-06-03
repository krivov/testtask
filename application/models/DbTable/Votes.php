<?php

/**
 * Class Application_Model_DbTable_Votes
 */
class Application_Model_DbTable_Votes extends Zend_Db_Table_Abstract
{
    protected $_name = 'votes';
    protected $_primary = array('city', 'color');
}

