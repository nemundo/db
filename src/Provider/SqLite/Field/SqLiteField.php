<?php

namespace Nemundo\Db\Provider\SqLite\Field;


use Nemundo\Db\Provider\SqLite\Table\SqLiteTable;


class SqLiteField
{

    /**
     * @var string
     */
    public $fieldName;

    /**
     * @var SqLiteFieldType
     */
    public $fieldType = SqLiteFieldType::TEXT;

    /**
     * @var string
     */
    private $tableName;

    public function __construct(SqLiteTable $table = null)
    {

        if ($table !== null) {
            $this->tableName = $table->tableName;
            $table->addField($this);
        }
        //$this->fieldType = new SqLiteFieldType();


    }


    public function getSql()
    {

        $sql = 'ALTER TABLE `' . $this->tableName . '` ADD `' . $this->fieldName . '` ' . $this->fieldType . ';';
        return $sql;

    }

}