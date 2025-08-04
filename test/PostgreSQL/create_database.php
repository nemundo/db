<?php

require __DIR__ . '/../config.php';

$conn = new \Nemundo\Db\Provider\Postgresql\Connection\PostgreSqlConnection();
$conn->connectionParameter->host = 'localhost';
$conn->connectionParameter->user = 'postgres';
$conn->connectionParameter->password = '123456';
$conn->connectionParameter->port = 5432;
$conn->connectionParameter->database = 'postgres';



$sql = new \Nemundo\Db\Sql\Parameter\SqlStatement();
$sql->sql ='CREATE TABLE IF NOT EXISTS test4
(
    vorname varchar(255),
    name text,
    id integer NOT NULL,
    CONSTRAINT test4_pkey PRIMARY KEY (id)
)';




//'CREATE DATABASE IF NOT EXISTS "postgres2";';



$exec = new \Nemundo\Db\Execute\SqlExecute();
$exec->connection=$conn;
$exec->execute($sql);


