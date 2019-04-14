<?php

namespace Nemundo\Db\Connection;

use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Db\DbConfig;
use Nemundo\Db\Log\SqlLog;
use Nemundo\Db\Sql\Parameter\SqlStatement;


abstract class AbstractConnection extends AbstractBaseClass
{

    /**
     * @var \PDO
     */
    private $pdo = null;

    /**
     * @var bool
     */
    protected $connected = false;


    abstract protected function connect();


    public function __construct()
    {
        $this->loadConnection();
    }

    protected function loadConnection()
    {

    }


    public function checkConnection()
    {
        $this->connect();
        return $this->connected;
    }

    protected function createPdoConnection($dataSourceName, $user = null, $password = null, $option = null)
    {

        if (!$this->connected) {
            //try {
            $this->pdo = new \PDO($dataSourceName, $user, $password, $option);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
            //} catch (\PDOException $e) {
            //  $errorMessage = 'Connect Error: ' . $e->getMessage();

            //(new LogMessage())->writeError($errorMessage);
            //exit;
            //}
        }

    }


    protected function disconnect()
    {
        $this->pdo = null;
    }


    public function execute(SqlStatement $sqlParameterList)
    {
        $this->prepareQuery($sqlParameterList);
        $id = $this->pdo->lastInsertId();
        return $id;
    }


    public function query(SqlStatement $sqlParameterList)
    {

        if (DbConfig::$logQuery) {
            (new SqlLog())->logSqlParameter($sqlParameterList);
        }


        //$time = new Stopwatch();

        $data = [];
        $query = $this->prepareQuery($sqlParameterList);
        try {
            if (is_object($query)) {
                $data = $query->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\PDOException $e) {
            $errorMessage = 'Query Error: ' . $e->getMessage() . 'Sql: ' . $sqlParameterList->sql;
            (new LogMessage())->writeError($errorMessage);
        }


        // Auslagern LogSlowQuery
        /*if (DbConfig::$slowQueryLog) {

            $queryTime = $time->stop();

            //(new Debug())->write('time:'.$queryTime);

            if ($queryTime > DbConfig::$slowQueryLimit) {

                //(new Debug())->write('slow');
                $file = new TextFile();
                $file->filename = LogConfig::$logPath . 'slow_query.log';
                $file->addLine((new DateTime())->setNow()->getIsoDateFormat() . ';' . $queryTime . ';' . (new SqlLog())->getSql($sqlParameterList));
            }

        }*/

        return $data;

    }


    public function queryRow(SqlStatement $sqlParameterList)
    {

        if (DbConfig::$logQuery) {
            (new SqlLog())->logSqlParameter($sqlParameterList);
        }

        $data = [];
        $query = $this->prepareQuery($sqlParameterList);
        try {
            if (is_object($query)) {
                $data = $query->fetch(\PDO::FETCH_ASSOC);
            }
        } catch (\PDOException $e) {
            $errorMessage = 'Query Error: ' . $e->getMessage() . 'Sql: ' . $sqlParameterList->sql;
            (new LogMessage())->writeError($errorMessage);
        }

        if ($data == null) {
            $data = [];
        }

        return $data;

    }


    public function queryValue(SqlStatement $sqlParameterList)
    {

        if (DbConfig::$logQuery) {
            (new SqlLog())->logSqlParameter($sqlParameterList);
        }

        $data = [];
        $query = $this->prepareQuery($sqlParameterList);
        try {
            if (is_object($query)) {
                $data = $query->fetch();
            }
        } catch (\PDOException $e) {
            $errorMessage = 'Query Error: ' . $e->getMessage() . 'Sql: ' . $sqlParameterList->sql;
            (new LogMessage())->writeError($errorMessage);
        }

        $value = '';
        if (isset($data[0])) {
            $value = $data[0];
        }

        return $value;

    }


    private function prepareQuery(SqlStatement $sqlParameterList)
    {

        $this->connect();

        $showErrorMessage = false;

        if (DbConfig::$sqlDebug) {
            (new Debug())->write($sqlParameterList->sql);
            (new Debug())->write($sqlParameterList->getParameterList());
        }

        if ($this->connected) {

            $query = null;
            try {

                $query = $this->pdo->prepare($sqlParameterList->sql);
                foreach ($sqlParameterList->getParameterList() as $parameter) {
                    $query->bindValue(':' . $parameter->key, $parameter->value);
                }

                $query->execute();

            } catch (\PDOException $error) {

                $showErrorMessage = true;

// Ausblenden, falls, vorhandene Spalte erstellt werden soll
                if (strpos($error->getMessage(), 'SQLSTATE[42S21]: Column already exists: 1060 Duplicate column name', 0) === 0) {
                    $showErrorMessage = false;
                }

// Ausblenden, falls, vorhandener Index erstellt werden soll
                if (strpos($error->getMessage(), 'SQLSTATE[42000]: Syntax error or access violation: 1061 Duplicate key name', 0) === 0) {
                    $showErrorMessage = false;
                }

// Fehlermeldung anzeigen
                if ($showErrorMessage) {
                    $errorMessage = 'Query Error: ' . $error->getMessage() . 'Sql: ' . $sqlParameterList->sql;
                    //echo $errorMessage;
                    (new LogMessage())->writeError($errorMessage);
                }
            }


//$time = $stopwatch->stop();

            /*if (DbConfig::$queryLog) {
            (new SqlLog())->logSqlParameter($sqlParameter, $time);
            }*/
            /*
                        if (DbConfig::$slowQueryLog) {

                            /*
                            if ($time > DbConfig::$slowQueryLimit) {
                                $sqlLog = new SqlLog();
                                $sqlLog->filename = 'slow_query_' . (new Date())->getIsoFormat() . '.log';
                                $sqlLog->logSqlParameter($sqlParameterList, $time);
                            }

            }*/

            return $query;

        }

        return $showErrorMessage;

    }

}
