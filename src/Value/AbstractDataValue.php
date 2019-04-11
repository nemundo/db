<?php

namespace Nemundo\Db\Value;


use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Filter\Filter;
use Nemundo\Db\Sql\Field\AbstractField;
use Nemundo\Db\Sql\Field\Aggregate\MaxField;
use Nemundo\Db\Sql\Field\Aggregate\MinField;
use Nemundo\Db\Sql\Field\Aggregate\SumField;
use Nemundo\Db\Sql\Order\SqlOrderTrait;
use Nemundo\Db\Sql\SelectQuery;


abstract class AbstractDataValue extends AbstractDbBase
{

    use SqlOrderTrait;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var AbstractField
     */
    public $field;

    /**
     * @var Filter
     */
    protected $filter;

    public function __construct()
    {
        parent::__construct();
        $this->filter = new Filter();
    }


    public function getValue()
    {

        if (!$this->checkProperty('tableName')) {
            return null;
        }

        $query = new SelectQuery();
        $query->tableName = $this->tableName;
        $query->addField($this->field);
        $query->filter = $this->filter;
        $query->limit = 1;


        foreach ($this->orderList as $order) {
            $query->addOrder($order->field, $order->sortOrder);
        }

        $value = $this->connection->queryValue($query->getSqlParameter());

        return $value;


    }


    public function getMinValue()
    {

        $field = new MinField();
        $field->aggregateField = $this->field;

        $query = new SelectQuery();
        $query->addField($field);
        $query->tableName = $this->tableName;
        $query->filter = $this->filter;

        $value = $this->connection->queryValue($query->getSqlParameter());

        return $value;
    }


    public function getMaxValue()
    {

        $field = new MaxField();
        $field->aggregateField = $this->field;

        $query = new SelectQuery();
        $query->addField($field);
        $query->tableName = $this->tableName;
        $query->filter = $this->filter;

        $value = $this->connection->queryValue($query->getSqlParameter());

        return $value;

    }


    public function getSumValue()
    {

        $field = new SumField();
        $field->aggregateField = $this->field;

        $query = new SelectQuery();
        $query->addField($field);
        $query->tableName = $this->tableName;
        $query->filter = $this->filter;

        $value = $this->connection->queryValue($query->getSqlParameter());

        return $value;

    }

}