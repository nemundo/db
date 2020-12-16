<?php

require __DIR__ . '/../config.php';


$field = new \Nemundo\Db\Provider\MySql\Field\MySqlField();
$field->tableName = 'camera_camera';
$field->fieldName = 'image';
$field->allowNull = false;
$field->modifyField();


