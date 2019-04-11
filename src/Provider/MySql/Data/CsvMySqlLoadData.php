<?php

namespace Nemundo\Db\Provider\MySql\Data;


use Nemundo\Core\Csv\Writer\CsvWriter;
use Nemundo\Core\File\Path;
use Nemundo\Core\File\UniqueFilename;
use Nemundo\Core\System\Delay;
use Nemundo\Core\Type\File\File;
use Nemundo\Core\Type\Text\Text;
use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Db\Sql\Parameter\SqlStatement;
use Nemundo\Db\Sql\Query\FieldNameList;
use Nemundo\Project\ProjectConfig;


// mit ausgelagertem Csv???
class CsvMySqlLoadData extends AbstractMySqlLoadData   // AbstractDbBase
{

    /**
     * @var string
     */
    public $csvFilename;

}