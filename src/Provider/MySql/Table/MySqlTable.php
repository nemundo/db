<?php

namespace Nemundo\Db\Provider\MySql\Table;

use Nemundo\Db\Index\AutoIncrementIdPrimaryIndex;
use Nemundo\Db\Index\NumberIdPrimaryIndex;
use Nemundo\Db\Index\TextIdPrimaryIndex;
use Nemundo\Db\Index\UniqueIdPrimaryIndex;
use Nemundo\Db\Provider\MySql\Field\MySqlField;
use Nemundo\Db\Provider\MySql\Field\MySqlTableFieldReader;
use Nemundo\Db\Provider\MySql\Index\MySqlIndexReader;
use Nemundo\Db\Reader\SqlReader;
use Nemundo\Db\Sql\Parameter\SqlStatement;
use Nemundo\Db\Table\AbstractTable;

class MySqlTable extends AbstractTable
{

    /**
     * @var string
     */
    public $charset = 'utf8';

    /**
     * @var MySqlEngine
     */
    public $engine = MySqlEngine::MY_ISAM;

    /**
     * @var MySqlField[]
     */
    private $fieldList = [];


    public function addField(MySqlField $field)
    {
        $this->fieldList[] = $field;
        return $this;
    }


    public function addTextField($fieldName, $length = 255, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'varchar(' . $length . ')';
        $field->allowNull = $allowNull;
        return $this;
    }

    public function addLargeTextField($fieldName, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'longtext';
        $field->allowNull = $allowNull;
        return $this;
    }

    public function addYesNoField($fieldName, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'bool';
        $field->allowNull = $allowNull;
        return $this;
    }

    public function addDateField($fieldName, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'date';
        $field->allowNull = $allowNull;
        return $this;
    }

    public function addTimeField($fieldName, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'time';
        $field->allowNull = $allowNull;
        return $this;
    }

    public function addDateTimeField($fieldName, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'datetime';
        $field->allowNull = $allowNull;
        return $this;
    }

    public function addNumberField($fieldName, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'int';
        //$field->fieldType = 'bigint';
        $field->allowNull = $allowNull;
        return $this;
    }

    public function addDecimalNumberField($fieldName, $allowNull = false)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'double';
        $field->allowNull = $allowNull;
        return $this;
    }


    public function addCreatedTimestamp($fieldName)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'timestamp';
        $field->defaultValue = 'CURRENT_TIMESTAMP';
        return $this;
    }


    public function addModifiedTimestamp($fieldName)
    {
        $field = new MySqlField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = 'timestamp';
        $field->defaultValue = 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
        return $this;
    }


    /**
     * @return string[]
     */
    public function getSql()
    {

        $primaryIndexDataType = null;

        switch ($this->primaryIndex->getClassName()) {

            case AutoIncrementIdPrimaryIndex::class:
                $primaryIndexDataType = 'int NOT NULL AUTO_INCREMENT';
                break;

            case UniqueIdPrimaryIndex::class:
                $primaryIndexDataType = 'varchar(36) NOT NULL';
                break;

            case NumberIdPrimaryIndex::class:
                $primaryIndexDataType = 'int NOT NULL';
                break;

            case TextIdPrimaryIndex::class:
                $primaryIndexDataType = 'varchar(36) NOT NULL';
                break;

        }

        $createTable = 'CREATE TABLE IF NOT EXISTS `' . $this->tableName . '` ';
        $createTable .= '(`' . $this->primaryIndex->fieldName . '` ' . $primaryIndexDataType . ', PRIMARY KEY (`' . $this->primaryIndex->fieldName . '`)) ';
        $createTable .= 'DEFAULT CHARSET=' . $this->charset . ' ENGINE=' . $this->engine . ';';

        $sql = [];
        $sql[] = $createTable;

        foreach ($this->fieldList as $field) {

            $fieldReader = new MySqlTableFieldReader();
            $fieldReader->tableName = $this->tableName;
            if (!$fieldReader->existsField($field->fieldName)) {
                $sql[] = $field->getSql();
            }
            $sql[] = $field->getModifySql();

        }

        foreach ($this->indexList as $index) {

            $indexReader = new MySqlIndexReader();
            $indexReader->tableName = $this->tableName;
            if (!$indexReader->existsIndex($index->indexName)) {
                $sql[] = $index->getSql();
            }

        }

        return $sql;

    }


    public function createTable()
    {

        if (!$this->checkConnection()) {
            return false;
        }

        /*
        if (!$this->checkProperty('tableName')) {
            return false;
        }


        if ((new Text($this->tableName))->getLength() > 64) {
            (new LogMessage())->writeError('Table Name "' . $this->tableName . '" is longer than 64 characters.');
            return false;
        }*/


        foreach ($this->getSql() as $sql) {
            $sqlParameter = new SqlStatement();
            $sqlParameter->sql = $sql;
            $this->connection->execute($sqlParameter);
        }

        return $this;

    }


    public function existsTable()
    {

        $sql = 'SELECT COUNT(1) FROM information_schema.TABLES 
WHERE (TABLE_SCHEMA = "' . $this->connection->connectionParameter->database . '") 
AND (TABLE_NAME = "' . $this->tableName . '")';

        $reader = new SqlReader();
        $reader->sqlStatement->sql = $sql;
        $row = $reader->getRow();

        $count = $row->getValueByNumber(0);

        $returnValue = false;

        if ($count > 0) {
            $returnValue = true;
        }

        return $returnValue;

    }


    public function renameTable($newTableName)
    {
        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = 'RENAME TABLE `' . $this->tableName . '` TO `' . $newTableName . '`;';
        $this->connection->execute($sqlParameter);
    }


    public function dropTable()
    {
        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = 'DROP TABLE IF EXISTS `' . $this->tableName . '`;';
        $this->connection->execute($sqlParameter);
    }

}

