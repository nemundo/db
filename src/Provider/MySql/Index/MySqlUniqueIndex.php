<?php

namespace Nemundo\Db\Provider\MySql\Index;


class MySqlUniqueIndex extends AbstractMySqlIndex
{

    protected function loadIndex()
    {
        $this->indexType = MySqlIndexType::UNIQUE;
    }

}