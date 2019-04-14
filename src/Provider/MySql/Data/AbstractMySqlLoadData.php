<?php

namespace Nemundo\Db\Provider\MySql\Data;


use Nemundo\Core\File\Path;
use Nemundo\Core\File\UniqueFilename;
use Nemundo\Core\Type\Text\Text;
use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Sql\Parameter\SqlStatement;
use Nemundo\Db\Sql\Query\FieldNameList;
use Nemundo\Project\ProjectConfig;


abstract class AbstractMySqlLoadData extends AbstractDbBase
{

    /**
     * @var string
     */
    protected $csvFilename;

    /**
     * @var string
     */
    public $tableName;

    /**
     * @var FieldNameList
     */
    private $fieldNameList;


    public function __construct()
    {

        parent::__construct();
        $this->fieldNameList = new FieldNameList();

        $this->csvFilename = (new Path())
            ->addPath(ProjectConfig::$tmpPath)
            ->addPath((new UniqueFilename())->getUniqueFilename('csv'))
            ->getFilename();

    }


    public function addFieldName($fieldName)
    {
        $this->fieldNameList->addFieldName($fieldName);
        return $this;
    }


    public function importData()
    {

        $filename = (new Text($this->csvFilename))
            ->replace('\\', '/')
            ->getValue();

        $sql = new SqlStatement();
        $sql->sql = 'LOAD DATA LOCAL INFILE "' . $filename . '" 
    INTO TABLE `' . $this->tableName . '`
    FIELDS TERMINATED BY \';\'
    OPTIONALLY ENCLOSED BY \'"\'
    (' . $this->fieldNameList->getFieldName() . ');';

        $this->connection->execute($sql);

    }

}