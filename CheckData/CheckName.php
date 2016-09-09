<?php
namespace CheckData;
use \StandardRequest\Request as Request;

class CheckName extends InterfaceCheckData
{

    const COLUMN = 'Name';

    const MAX_LENGTH = 4;

    const MIN_LENGTH = 2;

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
        if ($this->columnValue === NULL) { // when the Name column is set.
            throw new CheckDataException(
                    array(
                            'Column \'' . self::COLUMN . '\' undefined',
                            $this->columnValue
                    ));
        }
        if (! preg_match(
                '/^[\x{4e00}-\x{9fa5}]{' . self::MIN_LENGTH . ',' .
                         self::MAX_LENGTH . '}/u', $this->columnValue)) {
            throw new CheckDataException(
                    array(
                            'Invalid value of \'' . self::COLUMN . '\'',
                            $this->columnValue
                    ));
        }
    }
}

