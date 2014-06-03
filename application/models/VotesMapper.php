<?php

class Application_Model_VotesMapper extends Application_Model_TableMapper
{
    /**
     *
     */
    public function __construct()
    {
        $this->setDbTable('Application_Model_DbTable_Votes');
    }

    /**
     * Creates new model object.
     *
     * @return  Application_Model_Base
     */
    public function createModel()
    {
        return new Application_Model_Votes();
    }

    /**
     * Get sum of votes by param
     * @param $param
     *
     * @return int
     */
    public function sumVotesByParam($param)
    {
        $adapter = $this->getDbTable()->getAdapter();
        $select = $this->getDbTable()->select()->from('votes', array('SUM(votes) AS votes_sum'));
        foreach ($param as $paramName => $paramValue) {
            $select->where($adapter->quoteInto($paramName.' = ?', $paramValue));
        }

        $row = $this->getDbTable()->fetchRow($select)->toArray();
        if (isset($row['votes_sum'])) {
            return (int)$row['votes_sum'];
        } else {
            return 0;
        }
    }
}