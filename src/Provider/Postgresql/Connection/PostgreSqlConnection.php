<?php

namespace Nemundo\Db\Provider\Postgresql\Connection;

use Nemundo\Db\Connection\AbstractConnection;
use Nemundo\Db\Connection\ConnectionParameter;
use Nemundo\Db\Provider\MySql\Connection\MySqlConnectionParameter;

class PostgreSqlConnection extends AbstractConnection
{

    /**
     * @var MySqlConnectionParameter
     */
    public $connectionParameter;

    public function __construct()
    {
        $this->connectionParameter = new ConnectionParameter();
        parent::__construct();
    }


    protected function connect()
    {

        $property = [];
        $this->createPdoConnection('pgsql:host=' . $this->connectionParameter->host . ';port=' . $this->connectionParameter->port . ';dbname=' . $this->connectionParameter->database , $this->connectionParameter->user, $this->connectionParameter->password, $property);

    }

}