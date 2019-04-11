<?php

namespace Nemundo\Db\Provider\MySql\Field;


use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Provider\MySql\Table\MySqlTable;
use Nemundo\Db\Sql\Parameter\SqlStatement;


// MySqlColumn
// MySqlTableColumn
class MySqlField extends AbstractDbBase
{

    /**
     * @var string
     */
    public $tableName;

    /**
     * @var string
     */
    public $fieldName;

    /**
     * @var MySqlFieldType
     */
    public $fieldType = MySqlFieldType::VARCHAR_255;

    /**
     * @var int
     */
    public $fieldTypeLength;

    /**
     * @var string
     */
    public $defaultValue;

    /**
     * @var bool
     */
    public $allowNull = false;


    public function __construct(MySqlTable $mySqlTable = null)
    {

        parent::__construct();

        if ($mySqlTable !== null) {
            $mySqlTable->addField($this);
            $this->tableName = $mySqlTable->tableName;
        }

    }


    public function getSql()
    {

        $sql = 'ALTER TABLE `' . $this->tableName . '` ADD `' . $this->fieldName . '` ' . $this->fieldType;

        if (!$this->allowNull) {
            $sql .= ' NOT NULL';
        }

        if ($this->defaultValue !== null) {
            $sql .= ' DEFAULT ' . $this->defaultValue;
        }

        $sql .= ';';

        return $sql;

    }


    // createTableField
    public function createField()
    {

        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = $this->getSql();

        $this->connection->execute($sqlParameter);

    }


    /*
    public function modifyField()
    {

        // Modify Column
        /*if ($this->changeFieldTypeIfExists) {
            $sqlField = 'ALTER TABLE `' . $this->tableName . '` MODIFY `' . $field->fieldName . '` ' . $field->fieldType;
            if ($field->defaultValue !== null) {
                $sqlField .= ' DEFAULT ' . $field->defaultValue;
            }
            $sqlField .= ';';
            $sql->add($sqlField);
        }*/

    //}*/


    public function dropField()
    {

        $sql = 'ALTER TABLE `' . $this->tableName . '` DROP COLUMN `' . $this->fieldName . '`;';

        $sqlParameter = new SqlStatement();
        $sqlParameter->sql = $sql;
        $this->connection->execute($sqlParameter);

    }


}