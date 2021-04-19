<?php

require __DIR__.'/../config.php';


$conn = new \Nemundo\Db\Provider\MySql\Connection\MySqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->port=3333;
$conn->connectionParameter->user = 'root';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->database = 'flunet';


\Nemundo\Db\DbConfig::$slowQueryLog=true;
\Nemundo\Db\DbConfig::$slowQueryLogPath= 'c:\test\\';
\Nemundo\Db\DbConfig::$slowQueryLimit=-1;


$dataReader = new \Nemundo\Db\Reader\DataReader();
$dataReader->connection = $conn;
$dataReader->tableName = 'flunet_flu';

foreach ($dataReader->getData() as $row) {
    (new \Nemundo\Core\Debug\Debug())->write($row->getValue('id'));
}

