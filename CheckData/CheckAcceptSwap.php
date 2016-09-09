<?php
namespace CheckData;
use StandardRequest\Request;

class CheckAcceptSwap extends InterfaceCheckData
{

    const COLUMN = 'AcceptSwap';

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
                            'Column \''.self::COLUMN.'\' undefined',
                            $this->columnValue
                    ));
        }
        switch ($this->columnValue) {
            case '0':
            case '1': break;
            default:
                throw new CheckDataException(
                        array(
                                'Invalid value of \''.self::COLUMN.'\'',
                                $this->columnValue
                        ));
        }
    }
}

