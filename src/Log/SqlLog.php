<?php

namespace Nemundo\Db\Log;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogConfig;
use Nemundo\Core\Path\Path;
use Nemundo\Core\TextFile\Writer\TextFileWriter;
use Nemundo\Core\Type\Text\Text;
use Nemundo\Db\Sql\Parameter\SqlStatement;

class SqlLog extends AbstractBaseClass
{

    /**
     * @var string
     */
    public static $filename;


    public function getSql(SqlStatement $sqlStatement)
    {

        $sql = new Text($sqlStatement->sql);

        foreach ($sqlStatement->getParameterList() as $parameter) {
            $sql->replace(':' . $parameter->key, '"' . $parameter->value . '"');
        }

        return $sql->getValue();

    }


    public function logSqlParameter(SqlStatement $sqlParameter)
    {

        $this->logSql($this->getSql($sqlParameter));

    }


    public function logSql($sql)
    {

        if (SqlLog::$filename == null) {
            SqlLog::$filename = (new Path())
                ->addPath(LogConfig::$logPath)
                ->addPath('sql')
                ->addPath('sql_query.log')
                ->getFilename();
        }

        $file = new TextFileWriter(SqlLog::$filename);
        $file->appendToExistingFile = true;
        $file->addLine($sql);
        $file->saveFile();

    }

}