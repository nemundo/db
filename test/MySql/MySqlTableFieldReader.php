<?php

require __DIR__ . '/../config.php';

$reader = new \Nemundo\Db\Provider\MySql\Field\MySqlTableFieldReader();
$reader->tableName = 'file_file';
/*
foreach ($reader->getData() as $mySqlField) {
    (new \Nemundo\Core\Debug\Debug())->write($mySqlField->fieldName);
}*/

(new \Nemundo\Core\Debug\Debug())->write($reader->existsField('idasdf'));

