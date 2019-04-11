<?php

namespace Nemundo\Db;

use Nemundo\Db\Provider\MySql\Connection\MySqlConnection;
use Nemundo\Db\Provider\SqLite\Connection\SqLiteConnection;

class DbConfig
{

    /**
     * @var MySqlConnection|SqLiteConnection
     */
    public static $defaultConnection;

    /**
     * @var bool
     */
    public static $sqlDebug = false;

    /**
     * @var bool
     */
    public static $logQuery = false;

    /**
     * @var bool
     */
    public static $slowQueryLog = false;

    /**
     * @var float
     */
    public static $slowQueryLimit = 0.2;


}
