<?php

require __DIR__.'/../config.php';


$tableName = 'absenzmeldung_grund';


$reader = new \Nemundo\Db\Provider\MySql\Field\MySqlTableFieldReader();
$reader->tableName = $tableName;

foreach ($reader->getData() as $field) {
    (new \Nemundo\Core\Debug\Debug())->write($field->fieldType);
}


