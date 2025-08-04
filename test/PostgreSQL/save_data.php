<?php

require __DIR__ . '/../config.php';

$conn = new \Nemundo\Db\Provider\Postgresql\Connection\PostgreSqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'postgres';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->port = 5432;
$conn->connectionParameter->database = 'postgres';


/*
$sql = new \Nemundo\Db\Sql\Parameter\SqlStatement();
$sql->sql ='CREATE DATABASE IF NOT EXISTS "postgres2";';

$exec = new \Nemundo\Db\Execute\SqlExecute();
$exec->connection=$conn;
$exec->execute($sql);
*/


$loop = new \Nemundo\Core\Structure\ForLoop();
$loop->minNumber = 1;
$loop->maxNumber = 2000;
foreach ($loop->getData() as $number) {


$data = new \Nemundo\Db\Data\Data();
$data->connection = $conn;
$data->tableName = 'blog';  // 'test1';
$data
    //->setValue('id',(new \Nemundo\Core\Random\RandomNumber())->getNumber())
    ->setValue('title', 'bla bla bla '.$number)
    ->setValue('description', 'test test test')
    ->save();

}


//INSERT INTO x VALUES (point(3, 4));