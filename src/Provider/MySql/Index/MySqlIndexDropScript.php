<?php

namespace Nemundo\Db\Provider\MySql\Index;


use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Sql\Parameter\SqlStatement;

class MySqlIndexDropScript extends AbstractDbBase
{

    /**
     * @var string
     */
    private $tableName;

    public function __construct($tableName)
    {
        parent::__construct();
        $this->tableName = $tableName;
    }


    public function dropIndex()
    {

        //$keyNameList = [];

        $indexReader = new MySqlIndexReader();
        $indexReader->tableName = $this->tableName;
        foreach ($indexReader->getData() as $indexRow) {
            if ($indexRow->indexName !== 'PRIMARY') {
                //$keyNameList[] = $indexRow->indexName;

                $indexRow->dropIndex();

            }
        }


        /*
        $keyNameList = array_unique($keyNameList);

        foreach ($keyNameList as $keyName) {
            $sqlParameter = new SqlStatement();
            $sqlParameter->sql = 'ALTER TABLE `' . $this->tableName . '` DROP INDEX `' . $keyName . '`;';
            $this->connection->execute($sqlParameter);
        }*/

    }

}