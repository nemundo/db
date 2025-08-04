<?php

require __DIR__ . '/../config.php';

$conn = new \Nemundo\Db\Provider\Postgresql\Connection\PostgreSqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'postgres';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->port = 5432;
$conn->connectionParameter->database = 'postgres';


$delete = new \Nemundo\Db\Delete\DataDelete();
$delete->connection = $conn;
$delete->tableName = 'blog';
$delete->delete();

