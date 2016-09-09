<?php
namespace CheckData;
use StandardRequest\Request;

class CheckClassNumber extends InterfaceCheckData
{

    const COLUMN = 'ClassNumber';

    protected $legalClass;

    public function __construct (Request $Request)
    {
        if (isset($Request->{self::COLUMN})) {
            $this->legalClass = array(
                    1,
                    2,
                    3,
                    4,
                    5,
                    6,
                    7,
                    8
            );
            $this->columnValue = $Request->{self::COLUMN};
        } else {
            $this->columnValue = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->columnValue === NULL) {
            throw new CheckDataException(
                    'Column \'' . self::COLUMN . '\' undefined', 
                    $this->columnValue);
        }
        if (! in_array($this->columnValue, $this->legalClass)) {
            throw new CheckDataException(
                    'Invalid value of \'' . self::COLUMN . '\'', 
                    $this->columnValue);
        }
    }
}

