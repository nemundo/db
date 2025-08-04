<?php

require __DIR__ . '/../config.php';

$conn = new \Nemundo\Db\Provider\Postgresql\Connection\PostgreSqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'postgres';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->port = 5432;
$conn->connectionParameter->database = 'postgres';


$table = new \Nemundo\Db\Provider\Postgresql\Table\PostgresqlTable();
$table->connection = $conn;
$table->tableName='test22';

$table->addTextField('test22');

$table->createTable();





