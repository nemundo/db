<?php

namespace Nemundo\Db\Execute;


use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Sql\Parameter\SqlStatement;

abstract class AbstractSqlExecute extends AbstractDbBase
{

    protected function execute(SqlStatement $sql)
    {

        $this->loadConnection();
        $this->connection->execute($sql);

    }

}