<?php

use Nemundo\Db\Provider\MySql\Index\Drop\MySqlTableIndexDrop;

require __DIR__ . '/../config.php';


$tableName = 'xcontest_producer';
$indexName = 'date_time';


$drop =new MySqlTableIndexDrop($tableName);
$drop->dropAllIndex();

//$drop->dropIndex($indexName);
