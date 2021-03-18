<?php

namespace Nemundo\Db\Provider\MySql\Index\Drop;


use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Provider\MySql\Table\MySqlTableReader;


class MySqlDatabaseIndexDrop extends AbstractDbBase
{

    public function dropAllIndex()
    {

        $reader = new MySqlTableReader();
        $reader->connection = $this->connection;
        foreach ($reader->getData() as $mySqlTable) {
            (new MySqlTableIndexDrop($mySqlTable->tableName))->dropAllIndex();
        }

    }

}