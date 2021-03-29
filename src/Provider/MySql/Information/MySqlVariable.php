<?php


namespace Nemundo\Db\Provider\MySql\Information;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Db\Reader\SqlReader;

class MySqlVariable extends AbstractBase
{

    public function getValue($variableName)
    {

        $query = new SqlReader();
        $query->sqlStatement->sql = 'SHOW VARIABLES LIKE "' . $variableName . '"';
        $row = $query->getRow();
        $value = $row->getValue('Value');
        return $value;

    }

}