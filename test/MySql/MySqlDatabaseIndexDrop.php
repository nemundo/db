<?php

require __DIR__ . '/../config.php';


$drop=new \Nemundo\Db\Provider\MySql\Index\Drop\MySqlDatabaseIndexDrop();
$drop->dropAllIndex();