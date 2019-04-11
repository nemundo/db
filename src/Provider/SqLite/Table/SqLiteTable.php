<?php

namespace Nemundo\Db\Provider\SqLite\Table;


use Nemundo\Core\File\Directory;
use Nemundo\Core\Type\File\File;
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


    public function addTextField($fieldName, $length = null)
    {
        $field = new SqLiteField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = SqLiteFieldType::TEXT;
        return $this;
    }


    public function addLargeTextField($fieldName)
    {
        $this->addTextField($fieldName);
    }


    public function addNumberField($fieldName)
    {
        $field = new SqLiteField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = SqLiteFieldType::INTEGER;
        return $this;
    }


    public function addDecimalNumberField($fieldName)
    {
        $field = new SqLiteField($this);
        $field->fieldName = $fieldName;
        $field->fieldType = SqLiteFieldType::REAL;
        return $this;
    }


    public function addYesNoField($fieldName)
    {
        $this->addNumberField($fieldName);
        return $this;
    }


    public function addDateField($fieldName)
    {
        // TODO: Implement addDateField() method.
    }


    public function addDateTimeField($fieldName)
    {
        // TODO: Implement addDateTimeField() method.
    }

    public function addTimeField($fieldName)
    {
        // TODO: Implement addTimeField() method.
    }


    public function createTable()
    {

        // Create Path
        $path = (new File($this->connection->filename))->getPath();
        (new Directory($path))->createDirectory();

        if (!$this->checkProperty('tableName')) {
            return;
        }

        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = 'CREATE TABLE IF NOT EXISTS `' . $this->tableName . '` (`id` char(36), PRIMARY KEY (`id`));';
        $this->connection->execute($sqlParameter);


        foreach ($this->fieldList as $field) {

            $sqlParameter = new SqlStatement();
            $sqlParameter->sql = $field->getSql();

            $this->connection->execute($sqlParameter);

        }


        // Index
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



    public function renameTableField($fieldName, $newFieldName) {




    }


}