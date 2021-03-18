<?php

namespace Nemundo\Db\Provider\MySql\Index\Drop;


use Nemundo\Core\Debug\Debug;
use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Provider\MySql\Index\Reader\MySqlIndexReader;
use Nemundo\Db\Sql\Parameter\SqlStatement;

class MySqlTableIndexDrop extends AbstractDbBase
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


    public function dropAllIndex()
    {

        $indexReader = new MySqlIndexReader();
        $indexReader->connection=$this->connection;
        $indexReader->tableName = $this->tableName;
        foreach ($indexReader->getData() as $indexRow) {
            if ($indexRow->indexName !== 'PRIMARY') {
                //$keyNameList[] = $indexRow->indexName;

                //$indexRow->dropIndex();

                //(new Debug())->write($indexRow->indexName);

                $this->dropIndex($indexRow->indexName);


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



    public function dropIndex($indexName)
    {

        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = 'ALTER TABLE `' . $this->tableName . '` DROP INDEX `' . $indexName . '`;';
        $this->connection->execute($sqlParameter);

    }



}