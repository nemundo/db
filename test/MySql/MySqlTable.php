<?php

require '../config.php';


$table = new \Nemundo\Db\Provider\MySql\Table\MySqlTable();
$table->tableName = 'test';
$table->primaryKeyFieldName = 'id_test';

$table->addTextField('test1');



(new \Nemundo\Core\Debug\Debug())->write($table->getSql());


$table->createTable();


