<?php

require __DIR__.'/../config.php';



//$reader = new \Nemundo\Db\Reader\DataReader()


$pdo = new PDO("mysql:host=localhost;dbname=paranautik", 'root', '');

$uresult = $pdo->query("SELECT * FROM flight_flight");

while($row = $uresult->fetch()) {


    (new \Nemundo\Core\Debug\Debug())->write($row['id']);

}


http://allyouneedisbackend.com/blog/2017/09/24/the-sql-i-love-part-1-scanning-large-table/

SELECT user_id, external_id, name, metadata, date_created
FROM users
WHERE user_id > 51 234 123 --- value of user_id for 50 000 000th record
ORDER BY user_id ASC
LIMIT 10 000;





