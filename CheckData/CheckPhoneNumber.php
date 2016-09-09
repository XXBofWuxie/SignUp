<?php
namespace CheckData;
use StandardRequest\Request;

class CheckPhoneNumber extends InterfaceCheckData
{

    const COLUMN = 'PhoneNumber';

    public function __construct (Request $Request)
    {
        if (isset($Request->{self::PhoneNumber})) {
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
        if (! preg_match('/^1[3|4|5|7|8]\d{9}$/', $this->columnValue)) {
            throw new CheckDataException(
                    array(
                            'Invalid value of \'' . self::COLUMN . '\'',
                            $this->columnValue
                    ));
        }
        return FALSE;
    }
}

