<?php


namespace Nemundo\Db\Provider\MySql\Information;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Db\Reader\SqlReader;

class MySqlVariable extends AbstractBase
{

    public function getValue($variableName)
    {

        $query = new SqlReader();  // new MySqlQuery();  //new MySqlConnection();
        $query->sqlStatement->sql = 'SHOW VARIABLES LIKE "' . $variableName . '"';   //->queryRow($statement);
        $row = $query->getRow();
        $value = $row->getValue('Value');
        return $value;

    }

}