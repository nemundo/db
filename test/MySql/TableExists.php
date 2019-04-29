<?php

require '../config.php';


$table = new \Nemundo\Db\Provider\MySql\Table\MySqlTable('airport_airport2');
//$table->tableName = 'test';

if ($table->existsTable()) {
    (new \Nemundo\Core\Debug\Debug())->write('Table exists');
} else {
    (new \Nemundo\Core\Debug\Debug())->write('Table does not exist');
}