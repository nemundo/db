<?php

namespace Nemundo\Db\Delete;

use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Filter\Filter;
use Nemundo\Db\Sql\Parameter\SqlStatement;

abstract class AbstractDataDelete extends AbstractDbBase
{

    /**
     * @var Filter
     */
    public $filter;

    /**
     * @var string
     */
    protected $tableName;


    public function __construct()
    {
        parent::__construct();
        $this->filter = new Filter();
    }


    public function delete()
    {

        if (!($this->checkProperty('tableName'))) {
            return;
        }

        if (!$this->checkConnection()) {
            return;
        }

        $command = 'DELETE FROM `' . $this->tableName . '`';

        $whereSql = $this->filter->getSqlStatement()->sql;

        if ($whereSql !== '') {
            $command .= ' WHERE ' . $whereSql;
        }

        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = $command;
        $sqlParameter->addParameterList($this->filter->getSqlStatement()->getParameterList());

        $this->connection->execute($sqlParameter);

    }


}