<?php

namespace Nemundo\Db\Filter;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Db\Sql\Field\AbstractField;
use Nemundo\Db\Sql\Parameter\SqlStatement;
use Nemundo\Db\Sql\SqlConfig;


class FilterPart //extends AbstractBase
{

    /**
     * @var AbstractField
     */
    public $type;

    /**
     * @var string
     */
    public $fieldName;

    /**
     * @var string
     */
    public $value;

    /**
     * @var FilterCompareType
     */
    public $compareType = FilterCompareType::EQUAL;

    /**
     * @var bool
     */
    public $includeParameter = true;

    /**
     * @var bool
     */
    public $includeLink = true;

    /**
     * @var FilterLink
     */
    public $filterLink = FilterLink::AND_LINK;

    /**
     * @var bool
     */
    //public $openingBracket = false;

    /**
     * @var bool
     */
    //public $closingBracket = false;


    //private $sql = '';

    //private $variableName;

    // private $fieldCount = 0;


    public function getSqlParameter(SqlStatement $sqlParameterList)
    {

        $fieldName = $this->type->getConditionFieldName();

        $variableName = 'field_' . SqlConfig::$fieldCount;
        SqlConfig::$fieldCount++;

        if ($this->includeLink) {
            $sqlParameterList->sql = $sqlParameterList->sql . ' ' . $this->filterLink . ' ';  // . $fieldName . ' ' . CompareType::EQUAL . ' :' . $variableName;
        }

        if ($this->includeParameter) {

            //$sql = '';
            //if ($this->openingBracket) {
            //$sql = '(';
            //}

            $sqlParameterList->sql = $sqlParameterList->sql . $fieldName . ' ' . $this->compareType . ' :' . $variableName;

            $sqlParameterList->addParameter($variableName, $this->value, $fieldName);
        } else {
            $sqlParameterList->sql = $sqlParameterList->sql . $fieldName . ' ' . $this->compareType;
        }

        return $sqlParameterList;

    }

}