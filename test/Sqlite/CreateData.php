<?php

require __DIR__.'/../config.php';

$conn = new \Nemundo\Db\Provider\SqLite\Connection\SqLiteConnection();
$conn->filename = 'c:/test/test/test.db';

$tableName = 'test2';

$table = new \Nemundo\Db\Provider\SqLite\Table\SqLiteTable($tableName);
$table->connection = $conn;
$table->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();
$table->addTextField('test1');
$table->addTextField('test2');
$table->createTable();


$data = new \Nemundo\Db\Data\Data();
$data->connection = $conn;
$data->tableName = $tableName;
$data->setValue('test1', 'Bla');
$data->save();



