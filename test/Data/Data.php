<?php

require __DIR__ . '/../config.php';

$conn = new \Nemundo\Db\Provider\MySql\Connection\MySqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->port = 3333;
$conn->connectionParameter->user = 'root';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->database = 'flunet';

\Nemundo\Db\DbConfig::$slowQueryLog = true;
\Nemundo\Db\DbConfig::$slowQueryLogPath = 'c:\test\\';
\Nemundo\Db\DbConfig::$slowQueryLimit = -1;

$data = new \Nemundo\Db\Data\Data();
$data->connection = $conn;
$data->tableName = 'test';
$data->setValue('field1', 'value');
$data->save();

