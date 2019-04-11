<?php

namespace Nemundo\Db\Provider\MySql\Index;


use Nemundo\Db\Base\AbstractDbDataSource;
use Nemundo\Db\Reader\SqlReader;
use Nemundo\Db\Row\DataRow;

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

        $sql = 'SHOW INDEX FROM `' . $this->tableName . '`;';

        $reader = new SqlReader();
        $reader->connection = $this->connection;
        $reader->sqlStatement->sql = $sql;

        foreach ($reader->getData() as $row) {


            /*$tableField = new MySqlField();
            $tableField->fieldName = $row->getValue('COLUMN_NAME');
            $tableField->fieldType = $row->getValue('DATA_TYPE');
            $tableField->fieldTypeLength = $row->getValue('CHARACTER_MAXIMUM_LENGTH');
            $this->list[] = $tableField;*/
            $this->addItem($row);

        }

    }


    /**
     * @return DataRow[]
     */
    public function getData()
    {
        return parent::getData();
    }

}