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
    public $primaryIndex;  // = PrimaryIndex::AUTO_INCREMENT_ID;

    /**
     * @var string
     */
    //public $primaryKeyFieldName = 'id';

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

    abstract public function addTextField($fieldName, $length = 255);

    abstract public function addLargeTextField($fieldName);

    abstract public function addYesNoField($fieldName);

    abstract public function addDateField($fieldName);

    abstract public function addTimeField($fieldName);

    abstract public function addDateTimeField($fieldName);

    abstract public function addNumberField($fieldName);

    abstract public function addDecimalNumberField($fieldName);

    /*

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
*/


    public function addIndex(AbstractIndex $index)
    {
        $this->indexList[] = $index;
        return $this;
    }


}