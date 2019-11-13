<?php

namespace Nemundo\Db\Provider\MySql\Dump;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Type\File\File;
use Nemundo\Db\Base\AbstractDbBase;
use Nemundo\Core\Local\LocalCommand;

class MySqlDumpRestore extends AbstractDbBase
{

    /**
     * @var string
     */
    public $filename;

    public function restoreDumpFile()
    {

        if (!$this->checkProperty('filename')) {
            return;
        }

        $file = new File($this->filename);
        if ($file->fileExists()) {

            $command = 'mysql --user ' . $this->connection->connectionParameter->user . ' --password=' . $this->connection->connectionParameter->password . '  -h ' . $this->connection->connectionParameter->host . ' ' . $this->connection->connectionParameter->database . ' < ' . $this->filename;

            $cmd = new LocalCommand();
            $cmd->showOutput = false;
            $cmd->runLocalCommand($command);

        } else {
            (new LogMessage())->writeError('File does not exist. Filename: ' . $file->fullFilename);
        }

    }

}