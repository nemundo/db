<?php

require __DIR__ . '/../config.php';

$reader = new \Nemundo\Db\Provider\MySql\Index\MySqlIndexReader();
$reader->tableName = 'geo_distance';
$reader->existsIndex();

foreach ($reader->getData() as $mySqlIndex) {
    (new \Nemundo\Core\Debug\Debug())->write($mySqlIndex->indexName);
}

