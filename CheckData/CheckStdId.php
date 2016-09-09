<?php
namespace CheckData;
use StandardRequest\Request;

class CheckStdId extends InterfaceCheckData
{

    const COLUMN = 'StdId';

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
        if (! preg_match('2016\d{8}', $this->columnValue)) {
            throw new CheckDataException(
                    array(
                            'Invalid value of \'' . self::COLUMN . '\'',
                            $this->columnValue
                    ));
        }
    }
}

