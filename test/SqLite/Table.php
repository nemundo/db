<?php

require __DIR__.'/../config.php';

$conn = new \Nemundo\Db\Provider\SqLite\Connection\SqLiteConnection();
$conn->filename = 'C:\git\slu3000\db\slu3000.db';


$tableName = 'slu3000_container_type';


$reader = new \Nemundo\Db\Provider\SqLite\Field\SqLiteTableFieldReader();
$reader->connection = $conn;
$reader->tableName = $tableName;
foreach ($reader->getData() as $field) {
    (new \Nemundo\Core\Debug\Debug())->write($field->fieldName);
}




$table=new \Nemundo\Db\Provider\SqLite\Table\SqLiteTable($tableName);
$table->connection = $conn;


if ($table->existsField('type')) {
    (new \Nemundo\Core\Debug\Debug())->write('exists');
}


