<?php

namespace Nemundo\Db\Row;

use Nemundo\Core\Base\DataSource\AbstractRow;
use Nemundo\Db\Sql\Field\AbstractField;

abstract class AbstractDataRow extends AbstractRow
{

/*
    protected $data;

    public function __construct($data)
    {
        $data = array_change_key_case($data);
        $this->data = $data;
    }*/


   /* protected function getHeader()
    {
        $list = array_keys($this->data);
        return $list;
    }

    /*
    protected function getValue($name)
    {

        $name = strtolower($name);

        $value = '';
        if (array_key_exists($name, $this->data)) {
            $value = $this->data[$name];
        } else {
            (new LogMessage())->writeError('Row Column Name ' . $name . ' does not exist.');
            // Error Raise???
        }

        return $value;

    }*/



   /*
    protected function getValueByNumber($number)
    {

        $value = '';

        if (isset(array_values($this->data)[$number])) {
            $value = array_values($this->data)[$number];
        } else {
            (new LogMessage())->writeError('Row Field Number ' . $number . ' does not exist.');
        }

        return $value;

    }




    protected function getFieldValue(AbstractField $field)
    {

        $fieldName = $field->getFieldName();

        if ($field->aliasFieldName !== null) {
            $fieldName = $field->aliasFieldName;
        }

        return $this->getValue($fieldName);

    }*/

}