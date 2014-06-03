<?php

/**
 * Base table mapper class
 */
abstract class Application_Model_TableMapper
{
    /**
     * @var Zend_Db_Table_Abstract
     */
    protected $_dbTable;

    /**
     * @param string $dbTable
     *
     * @return $this
     * @throws Exception
     */
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    /**
     * @return Zend_Db_Table_Abstract
     */
    public function getDbTable()
    {
        return $this->_dbTable;
    }

    /**
     * Creates new model object.
     *
     * @return  Application_Model_Base
     */
    abstract public function createModel();

    /**
     * @param $id
     * @return Application_Model_Base|null
     */
    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return NULL;
        }
        $row = $result->current();
        $model = $this->createModel();
        return $model->setOptions($row->toArray());
    }


    /**
     * @param Application_Model_Base $model
     */
    public function save(Application_Model_Base &$model)
    {
        $data = $model->toArray();
        $pkName = $this->getDbTable()->info('primary');
        is_array($pkName) && $pkName = reset($pkName);

        if (null === ($id = $model->__get($pkName))) {
            $pkValue = $this->getDbTable()->insert($data);
            $model->__set($pkName, $pkValue);
        } else {
            $this->getDbTable()->update(
                $data,
                array(sprintf('%s = ?', $pkName) => $id)
            );
        }
    }

    /**
     * Removes given $model from database
     * @param Application_Model_Base $model
     * @throws Zend_Exception
     */
    public function delete(Application_Model_Base $model)
    {
        $pkName = $this->getDbTable()->info('primary');
        is_array($pkName) && $pkName = reset($pkName);

        $class = get_class($this->createModel());

        if (!$model instanceof $class) {
            throw new Zend_Exception(
                sprintf(
                    "Parameter of type '%s' given, expected '%s'",
                    get_class($model),
                    $model
                )
            );
        }

        $this->getDbTable()
            ->delete(
                array(sprintf('%s = ?', $pkName) => $model->__get($pkName))
            );
    }


    /**
     * @param null $where
     * @param null $order
     * @param null $count
     * @param null $offset
     *
     * @return array
     */
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $resultSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->createModel()->setOptions($row->toArray());
        }
        return $entries;
    }
}

