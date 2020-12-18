<?php

require __DIR__ . '/../config.php';

$index=new \Nemundo\Db\Provider\MySql\Index\MySqlIndexReader();
$index->tableName = 'test_index';

(new \Nemundo\Core\Debug\Debug())->write($index->existsIndex('test1'));

