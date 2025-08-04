<?php

require __DIR__ . '/../config.php';


//$conStr =
//"pgsql:host=localhost;port=5432;dbname=luv;user=postgres;password=123456";

$conn = new \Nemundo\Db\Provider\Postgresql\Connection\PostgreSqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'postgres';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->port = 5432;
$conn->connectionParameter->database = 'postgres';


$reader = new \Nemundo\Db\Reader\DataReader();
$reader->connection = $conn;
$reader->tableName= 'test1';
foreach ($reader->getData() as $row) {

    (new \Nemundo\Core\Debug\Debug())->write($row->getValue('vorname'));

}


/*
$sql = new \Nemundo\Db\Sql\Parameter\SqlStatement();
$sql->sql ='CREATE DATABASE IF NOT EXISTS "postgres2";';

$exec = new \Nemundo\Db\Execute\SqlExecute();
$exec->connection=$conn;
$exec->execute($sql);
*/


/*
$data = new \Nemundo\Db\Data\Data();
$data->connection = $conn;
$data->tableName = 'test1';
$data
    ->setValue('id',(new \Nemundo\Core\Random\RandomNumber())->getNumber())
    ->setValue('name', 'Lang')
    ->setValue('vorname', 'Urs')
    ->save();
*/