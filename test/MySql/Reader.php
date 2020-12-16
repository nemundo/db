<?php

require __DIR__.'/../config.php';

$conn = new \Nemundo\Db\Provider\MySql\Connection\MySqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'root';
$conn->connectionParameter->password = '';
$conn->connectionParameter->database = 'hackday';


$reader = new \Nemundo\Db\Reader\DataReader();
$reader->connection = $conn;
$reader->tableName = 'sbb_train';
foreach ($reader->getData() as $row) {
    (new \Nemundo\Core\Debug\Debug())->write($row->getValue('id'));
    (new \Nemundo\Core\Debug\Debug())->write($row->getValue('spalte5'));

}



