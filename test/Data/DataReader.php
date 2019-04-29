<?php

require '../vendor/autoload.php';


$conn = new \Nemundo\Db\Provider\MySql\Connection\MySqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'root';
$conn->connectionParameter->password = '';
$conn->connectionParameter->database = 'paranautik';

$dataReader = new \Nemundo\Db\Reader\DataReader();
$dataReader->connection = $conn;
$dataReader->tableName = 'flight_year';

foreach ($dataReader->getData() as $row) {
    //(new \Nemundo\Core\Debug\Debug())->write($row->getValue('field1'));

    print_r($row->getValue('id'));

}

