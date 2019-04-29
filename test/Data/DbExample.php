<?php

require '../vendor/autoload.php';


$conn = new \Nemundo\Db\Provider\MySql\Connection\MySqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'root';
$conn->connectionParameter->password = '1';
$conn->connectionParameter->database = 'test';

$db = new \Nemundo\Db\Provider\MySql\Database\MySqlDatabase();
$db->connection = $conn;
$db->createDatabase();


$tableName = 'test';


$table = new \Nemundo\Db\Provider\MySql\Table\MySqlTable();
$table->connection = $conn;
$table->tableName =$tableName;
//$table->primaryKeyFieldName = 'irgendwas';

//(new \Nemundo\Core\Debug\Debug())->write($table->getSql());

$table->addTextField('name');
$table->addTextField('last_name');

$table->createTable();

for ($n=0;$n<10;$n++) {
$data = new \Nemundo\Db\Data\Data();
$data->connection = $conn;
$data->tableName = $tableName;
$data->setValue('name', "TestName$n");
$data->save();
}






$dataReader = new \Nemundo\Db\Reader\DataReader();
$dataReader->connection = $conn;
$dataReader->tableName =$tableName;

foreach ($dataReader->getData() as $row) {
    //(new \Nemundo\Core\Debug\Debug())->write($row->getValue('field1'));

    print_r($row->getValue('id'));

}

