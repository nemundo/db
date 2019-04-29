<?php

require __DIR__.'/../config.php';

$conn = new \Nemundo\Db\Provider\SqLite\Connection\SqLiteConnection();
$conn->filename = 'c:/test/test.db';

$tableName = 'test1';

$reader = new \Nemundo\Db\Reader\DataReader();
$reader->connection = $conn;
$reader->tableName = $tableName;
foreach ($reader->getData() as $row) {

    (new \Nemundo\Core\Debug\Debug())->write($row->getValue('test1'));
    (new \Nemundo\Core\Debug\Debug())->write($row->getValue('test2'));


}
