<?php

require '../config.php';


$data = new \Nemundo\Db\Data\Data();
$data->tableName = 'test';
$data->setValue('field1', 'value');
$data->save();

