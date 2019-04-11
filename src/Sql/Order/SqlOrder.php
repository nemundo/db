<?php

namespace Nemundo\Db\Sql\Order;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Db\Sql\Field\AbstractField;


// Order
// SqlOrder
class SqlOrder //extends AbstractBase
{

    /**
     * @var string
     */
    //public $fieldName;

    /**
     * @var AbstractField
     */
    public $field;

    /**
     * @var SortOrder
     */
    public $sortOrder = SortOrder::ASCENDING;


    public function getSql()
    {
        $sql = $this->field->getConditionFieldName() . ' ' . $this->sortOrder;


        // falls Random darf kein Feld Name definiert sein
        if ($this->sortOrder == SortOrder::RANDOM) {
            //$this->fieldName = '';
            $sql = SortOrder::RANDOM;
        }

        //$sql = $this->fieldName . ' ' . $this->sortOrder;


        return $sql;

    }


}