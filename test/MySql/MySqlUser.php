<?php

require __DIR__.'/../config.php';

$user = new \Nemundo\Db\Provider\MySql\User\MySqlUser();
$user->login = 'test3';
$user->password='123456';
$user->database='tg';
$user->createUser();