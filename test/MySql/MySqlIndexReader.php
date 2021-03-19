<?php

require __DIR__ . '/../config.php';

$tableName = 'xcontest_flight';

$reader =  new \Nemundo\Db\Provider\MySql\Index\Reader\MySqlIndexReader();
$reader->tableName = $tableName;

foreach ($reader->getData() as $mySqlIndex) {
    (new \Nemundo\Core\Debug\Debug())->write($mySqlIndex->indexName);
}

