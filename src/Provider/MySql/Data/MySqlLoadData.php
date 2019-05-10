<?php

namespace Nemundo\Db\Provider\MySql\Data;


use Nemundo\Core\Csv\Writer\CsvWriter;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\File\Path;
use Nemundo\Core\File\UniqueFilename;
use Nemundo\Project\ProjectConfig;


// mit ausgelagertem Csv???
class MySqlLoadData extends AbstractMySqlLoadData   // AbstractDbBase
{

    /**
     * @var string
     */
   // public $tmpPath;

    /**
     * @var CsvWriter
     */
    private $csvWriter;


    public function __construct($tmpPath)
    {

        parent::__construct();
        //$this->fieldNameList = new FieldNameList();

        $this->csvFilename = (new Path())
            ->addPath($tmpPath)   //ProjectConfig::$tmpPath)
            ->addPath((new UniqueFilename())->getUniqueFilename('csv'))
            ->getFilename();

        //(new Debug())->write($csvFilename);

        //exit;

        $this->csvWriter = new CsvWriter($this->csvFilename);

    }


    public function addRow($data)
    {

        $this->csvWriter->addRow($data);
        return $this;

    }


    public function importData()
    {

        $this->csvWriter->closeFile();
        parent::importData();

    }

}