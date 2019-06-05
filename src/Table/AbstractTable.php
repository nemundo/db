<?php

namespace Nemundo\Db\Table;


use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Index\AbstractIndex;
use Nemundo\Db\Index\AbstractPrimaryIndex;
use Nemundo\Db\Index\AutoIncrementIdPrimaryIndex;

abstract class AbstractTable extends AbstractDbBase
{

    /**
     * @var string
     */
    public $tableName;

    /**
     * @var AbstractPrimaryIndex
     */
    public $primaryIndex;

    /**
     * @var bool
     */
    public $changeFieldTypeIfExists = false;

    /**
     * @var AbstractIndex[]
     */
    protected $indexList = [];


    public function __construct($tableName = null)
    {
        parent::__construct();
        $this->tableName = $tableName;
        $this->primaryIndex = new AutoIncrementIdPrimaryIndex();
    }

    abstract public function createTable();

    abstract public function renameTable($newTableName);

    abstract public function dropTable();

    abstract public function addTextField($fieldName, $length = 255, $allowNull = false);

    abstract public function addLargeTextField($fieldName, $allowNull = false);

    abstract public function addYesNoField($fieldName, $allowNull = false);

    abstract public function addDateField($fieldName, $allowNull = false);

    abstract public function addTimeField($fieldName, $allowNull = false);

    abstract public function addDateTimeField($fieldName, $allowNull = false);

    abstract public function addNumberField($fieldName, $allowNull = false);

    abstract public function addDecimalNumberField($fieldName, $allowNull = false);

    public function addIndex(AbstractIndex $index)
    {
        $this->indexList[] = $index;
        return $this;
    }

}