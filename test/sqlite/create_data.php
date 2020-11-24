<?php

require __DIR__ . '/../config.php';

$filename = 'c:/test/test.db';

//(new \Nemundo\Core\Type\File\File($filename))->deleteFile();

$conn = new \Nemundo\Db\Provider\SqLite\Connection\SqLiteConnection();
$conn->filename = $filename;

$tableName = 'test2';

$table = new \Nemundo\Db\Provider\SqLite\Table\SqLiteTable($tableName);
$table->connection = $conn;
$table->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();
$table->addTextField('test1', 255, false);
$table->addTextField('test2');
$table->addNumberField('number1', true);
$table->addDecimalNumberField('number2', true);
$table->createTable();

$data = new \Nemundo\Db\Data\Data();
$data->connection = $conn;
$data->tableName = $tableName;
$data->setValue('test1', 'Bla');
$data->save();
