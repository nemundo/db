<?php

namespace Nemundo\Db\Provider\SqLite\Table;


use Nemundo\Core\Path\Path;
use Nemundo\Core\Type\File\File;
use Nemundo\Db\Index\AutoIncrementIdPrimaryIndex;
use Nemundo\Db\Index\NumberIdPrimaryIndex;
use Nemundo\Db\Index\TextIdPrimaryIndex;
use Nemundo\Db\Index\UniqueIdPrimaryIndex;
use Nemundo\Db\Provider\SqLite\Field\SqLiteField;
use Nemundo\Db\Provider\SqLite\Field\SqLiteFieldType;
use Nemundo\Db\Sql\Parameter\SqlStatement;
use Nemundo\Db\Table\AbstractTable;


class SqLiteTable extends AbstractTable
{

    /**
     * @var SqLiteField[]
     */
    private $fieldList = [];

    public function addField(SqLiteField $field)
    {
        $this->fieldList[] = $field;
        return $this;
    }


    public function addTextField($fieldName, $length = null, $allowNull = true)
    {
        $field = new SqLiteField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = SqLiteFieldType::TEXT;
        $field->allowNull = $allowNull;
        return $this;
    }


    public function addLargeTextField($fieldName, $allowNull = false)
    {
        $this->addTextField($fieldName, $allowNull);
    }


    public function addNumberField($fieldName, $allowNull = false)
    {
        $field = new SqLiteField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = SqLiteFieldType::INTEGER;
        $field->allowNull = $allowNull;
        return $this;
    }


    public function addDecimalNumberField($fieldName, $allowNull = false)
    {
        $field = new SqLiteField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = SqLiteFieldType::REAL;
        $field->allowNull = $allowNull;
        return $this;
    }


    public function addYesNoField($fieldName, $allowNull = false)
    {
        $this->addNumberField($fieldName, $allowNull);
        return $this;
    }


    public function addDateField($fieldName, $allowNull = false)
    {
        // TODO: Implement addDateField() method.
    }


    public function addDateTimeField($fieldName, $allowNull = false)
    {
        // TODO: Implement addDateTimeField() method.
    }

    public function addTimeField($fieldName, $allowNull = false)
    {
        // TODO: Implement addTimeField() method.
    }


    public function createTable()
    {

        (new Path())
            ->addPath((new File($this->connection->filename))->getPath())
            ->createPath();

        if (!$this->checkProperty('tableName')) {
            return;
        }

        $primaryIndexDataType = null;

        switch ($this->primaryIndex->getClassName()) {

            case AutoIncrementIdPrimaryIndex::class:
                $primaryIndexDataType = 'INTEGER PRIMARY KEY AUTOINCREMENT';
                break;

            case UniqueIdPrimaryIndex::class:
                $primaryIndexDataType = 'varchar(36) PRIMARY KEY';
                break;

            case NumberIdPrimaryIndex::class:
                $primaryIndexDataType = 'INTEGER PRIMARY KEY';
                break;

            case TextIdPrimaryIndex::class:
                $primaryIndexDataType = 'varchar(36) PRIMARY KEY';
                break;

        }

        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = 'CREATE TABLE IF NOT EXISTS `' . $this->tableName . '` (`id` ' . $primaryIndexDataType . ');';

        $this->connection->execute($sqlParameter);

        foreach ($this->fieldList as $field) {

            $sqlParameter = new SqlStatement();
            $sqlParameter->sql = $field->getSql();

            $this->connection->execute($sqlParameter);

        }

        foreach ($this->indexList as $index) {
            $sqlParameter = new SqlStatement();
            $sqlParameter->sql = $index->getSql();
            $this->connection->execute($sqlParameter);
        }

    }


    public function renameTable($newTableName)
    {

        // ALTER TABLE foo RENAME TO bar

        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = 'ALTER TABLE `' . $this->tableName . '` RENAME TO `' . $newTableName . '`;';
        $this->connection->execute($sqlParameter);

    }

    public function dropTable()
    {
        // TODO: Implement dropTable() method.
    }


    public function renameTableField($fieldName, $newFieldName)
    {


    }


}