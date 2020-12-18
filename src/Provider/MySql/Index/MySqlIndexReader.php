<?php

namespace Nemundo\Db\Provider\MySql\Index;


use Nemundo\Db\Base\AbstractDbDataSource;
use Nemundo\Db\Provider\MySql\Table\MySqlTable;
use Nemundo\Db\Reader\SqlReader;

class MySqlIndexReader extends AbstractDbDataSource
{

    /**
     * @var string
     */
    public $tableName;


    protected function loadData()
    {

        if (!$this->checkProperty('tableName')) {
            return;
        }

        if (!$this->checkConnection()) {
            return;
        }


        $this->checkConnection();

        $tableReader = new MySqlTable();
        $tableReader->tableName = $this->tableName;
        if ($tableReader->existsTable()) {

            $sql = 'SHOW INDEX FROM `' . $this->tableName . '`;';

            $reader = new SqlReader();
            $reader->connection = $this->connection;
            $reader->sqlStatement->sql = $sql;

            foreach ($reader->getData() as $row) {

                $index = new MySqlUniqueIndex();
                $index->indexName = $row->getValue('key_name');


                /*$tableField = new MySqlField();
                $tableField->fieldName = $row->getValue('COLUMN_NAME');
                $tableField->fieldType = $row->getValue('DATA_TYPE');
                $tableField->fieldTypeLength = $row->getValue('CHARACTER_MAXIMUM_LENGTH');
                $this->list[] = $tableField;*/
                $this->addItem($index);

            }

        }

    }


    /**
     * @return AbstractMySqlIndex[]
     */
    public function getData()
    {
        return parent::getData();
    }


    public function existsIndex($indexName)
    {

        $exists = false;
        foreach ($this->getData() as $mySqlIndex) {
            if ($mySqlIndex->indexName == $indexName) {
                $exists = true;
            }
        }
        return $exists;

    }


}