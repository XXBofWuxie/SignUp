<?php
namespace CheckData;
use StandardRequest\Request;

class CheckRoom extends InterfaceCheckData
{

    const COLUMN = 'Room';

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
        if (! preg_match('/^\d{3}$/', $this->columnValue)) {
            throw new CheckDataException(
                    array(
                            'Column \'' . self::COLUMN . '\' undefined',
                            $this->columnValue
                    ));
        }
    }
}

