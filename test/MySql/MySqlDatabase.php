<?php

require __DIR__ . '/../config.php';

$connection = new \Nemundo\Db\Provider\MySql\Connection\MySqlConnection();
$connection->connectionParameter->host = 'localhost';
$connection->connectionParameter->user = 'root';
$connection->connectionParameter->password = '';
//$connection->connectionParameter->database = 'hackday';


$mysqlDatabase = new \Nemundo\Db\Provider\MySql\Database\MySqlDatabase('test123');
$mysqlDatabase->connection = $connection;
$mysqlDatabase->createDatabase();
