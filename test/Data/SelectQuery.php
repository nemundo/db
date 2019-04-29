<?php

require '../config.php';


$select = new \Nemundo\Db\Sql\SelectQuery();
$select->tableName = 'test1';

$reader = new \Nemundo\Db\Reader\SqlReader();
$reader->sqlStatement = $select->getSqlParameter();

foreach ($reader->getData() as $row) {

    (new \Nemundo\Core\Debug\Debug())->write($row);

}
