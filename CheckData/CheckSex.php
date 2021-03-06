<?php
namespace CheckData;
use StandardRequest\Request;

class CheckSex extends InterfaceCheckData
{

    const COLUMN = 'Sex';

    protected $legalSex;

    public function __construct (Request $Request)
    {
        if (isset($Request->{self::COLUMN})) {
            $this->legalSex = array(
                    0,
                    1
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
                    array(
                            'Column \'' . self::COLUMN . '\' undefined',
                            $this->columnValue
                    ));
        }
        if (! in_array($this->columnValue, $this->Sex)) {
            throw new CheckDataException(
                    array(
                            'Invalid value of \'' . self::COLUMN . '\'',
                            $this->columnValue
                    ));
        }
    }
}

