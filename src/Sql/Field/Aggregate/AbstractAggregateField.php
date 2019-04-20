<?php

namespace Nemundo\Db\Sql\Field\Aggregate;

use Nemundo\Db\Sql\Field\AbstractField;

abstract class AbstractAggregateField extends AbstractField
{

    /**
     * @var AbstractField
     */
    public $aggregateField;


    // roundFieldTrait


    /**
     * @var bool
     */
    //public $roundNumber = false;

    /**
     * @var int
     */
    public $roundDecimal;  // = 2;

    /**
     * @var string
     */
    protected $aggregateFunction;

    /**
     * @var string
     */
    protected $prefix;


    public function getFieldName()
    {

        $sql = $this->aggregateFunction . '(' . $this->aggregateField->getConditionFieldName() . ') ';

        //if ($this->roundNumber) {
        if ($this->roundDecimal !== null) {
            $sql = 'ROUND(' . $sql . ', ' . $this->roundDecimal . ') ';
        }

        $sql .= $this->getConditionFieldName();

        return $sql;
    }


    public function getConditionFieldName()
    {

        $fieldName = $this->prefix . '_' . $this->aggregateField->fieldName;
        $this->aliasFieldName = $fieldName;

        return $fieldName;

    }

}