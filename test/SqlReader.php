<?php

require '../config.php';


$sqlReader = new \Nemundo\Db\Reader\SqlReader();
$sqlReader->sqlStatement->sql = 'SELECT * FROM test';

foreach ($sqlReader->getData() as $row) {
    \Nemundo\Core\Utility\Debug::write($row->getValue('field1'));
}

