<?php
namespace CheckData;
use StandardRequest\Request;

class CheckDormitory extends InterfaceCheckData
{

    const COLUMN = 'Dorimtory';

    public function __construct (Request $Request)
    {
        if (isset($Request->{self::COLUMN})) {
            $this->column_value = $Request->{self::COLUMN};
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value === NULL) {
            throw new CheckDataException(
                    array(
                            'Column \'' . self::COLUMN . '\' undefined',
                            $this->columnValue
                    ));
        }
        if (! preg_match('/^[c|C][2|4|7]$/', $this->column_value)) {
            throw new CheckDataException(
                    array(
                            'Invalid value of \'' . self::COLUMN . '\'',
                            $this->columnValue
                    ));
        }
    }
}

