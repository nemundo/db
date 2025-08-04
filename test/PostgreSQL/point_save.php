<?php

require __DIR__ . '/../config.php';

$conn = new \Nemundo\Db\Provider\Postgresql\Connection\PostgreSqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'postgres';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->port = 5432;
$conn->connectionParameter->database = 'postgres';


$uid = (new \Nemundo\Core\Random\UniqueId())->getUniqueId();

$sql=new \Nemundo\Db\Sql\Parameter\SqlStatement();
$sql->sql='INSERT INTO tour2 (point) VALUES (point(1,2));';


$conn->execute($sql);



