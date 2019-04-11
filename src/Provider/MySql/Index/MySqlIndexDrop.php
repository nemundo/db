<?php

namespace Nemundo\Db\Provider\MySql\Index;


use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Sql\Parameter\SqlStatement;

class MySqlIndexDrop extends AbstractDbBase
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


        $keyNameList = [];

        $reader = new MySqlIndexReader();
        $reader->tableName = $this->tableName;
        foreach ($reader->getData() as $row) {

            $keyName = $row->getValue('key_name');

            if ($keyName !== 'PRIMARY') {

                $keyNameList[] = $keyName;
            }

        }

        $keyNameList = array_unique($keyNameList);

        foreach ($keyNameList as $keyName) {
            $sqlParameter = new SqlStatement();
            $sqlParameter->sql = 'ALTER TABLE `' . $this->tableName . '` DROP INDEX ' . $keyName . ';';
            $this->connection->execute($sqlParameter);
        }


    }


}