<?php

require __DIR__ . '/../config.php';

(new \Nemundo\Db\Provider\MySql\Index\Drop\MySqlDatabaseIndexDrop())->dropAllIndex();
