<?php

namespace Nemundo\Db\Data;


use Nemundo\Core\Directory\TextDirectory;
use Nemundo\Db\Sql\InsertQuery;

abstract class AbstractDataBulk extends AbstractData
{

    /**
     * @var InsertQuery
     */
    private $insertQuery;

    /**
     * @var int
     */
    private $bulkCount;

    /**
     * @var TextDirectory
     */
    private $valuePart;

    public function __construct()
    {

        parent::__construct();
        $this->loadDataBulk();

    }


    private function loadDataBulk()
    {

        $this->bulkCount = 0;
        $this->insertQuery = new InsertQuery();
        $this->valuePart = new TextDirectory();

    }


    protected function setValue($fieldName, $value)
    {

        if ($this->bulkCount == 0) {
            $this->insertQuery->addField($fieldName);
        }

        $this->insertQuery->addValue($fieldName, $value);

    }


    public function save()
    {

        $this->valuePart = new TextDirectory();
        $this->bulkCount++;

        $this->insertQuery->closeValuePart();

        if ($this->bulkCount > 1000) {
            $this->saveBulk();

        }

    }


    public function saveBulk()
    {

        if ($this->bulkCount > 0) {

            $this->insertQuery->tableName = $this->tableName;
            $this->insertQuery->ignoreIfExists = $this->ignoreIfExists;
            $this->insertQuery->updateOnDuplicate = $this->updateOnDuplicate;

            $sqlParameter = $this->insertQuery->getSqlParameter();
            $this->connection->execute($sqlParameter);

        }

        $this->loadDataBulk();


    }

}