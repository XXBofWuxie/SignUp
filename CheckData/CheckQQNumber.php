<?php
namespace CheckData;
use StandardRequest\Request;

class CheckQQNumber extends InterfaceCheckData
{

    const COLUMN = 'QQNumber';

    public function __construct (Request $Request)
    {
        if (isset($Request->{self::COLUMN})) {
            $this->columnValue = $Request->{self::COLUMN};
        } else {
            $this->columnValue = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->columnValue === NULL) {
            throw new CheckDataException(
                    array(
                            'Column \'' . self::COLUMN . '\' undefined',
                            $this->columnValue
                    ));
        }
        if (! preg_match('/^[1-9]\d{4,9}$/', $this->columnValue) ||
                 $this->columnValue == '') {
            throw new CheckDataException(
                    array(
                            'Invalid value of \'' . self::COLUMN . '\'',
                            $this->columnValue
                    ));
        }
        return FALSE;
    }
}
