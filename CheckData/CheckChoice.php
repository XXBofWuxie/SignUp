<?php
namespace CheckData;
use StandardRequest\Request;

class CheckChoice extends InterfaceCheckData
{

    const COLUMN_FIRST = 'FirstChoice';

    const COLUMN_SECOND = 'SecondChoice';

    protected $legalChoice;

    protected $techChoice;

    public function __construct (Request $Request)
    {
        if (isset($Request->{self::COLUMN_FIRST}) &&
                 isset($Request->{self::COLUMN_SECOND})) {
            $this->techChoice = array(
                    1,
                    2,
                    3
            );
            $this->legalChoice = array(
                    1,
                    2,
                    3,
                    4,
                    5,
                    6,
                    7,
                    8
            );
            $this->columnValue[] = $Request->{self::COLUMN_FIRST};
            $this->columnValue[] = $Request->{self::COLUMN_SECOND};
        } else {
            $this->columnValue = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value === NULL) {
            throw new CheckDataException(
                    array(
                            'Column \'' . self::COLUMN_FIRST . '\' OR \'' .
                                     self::COLUMN_SECOND . '\' undefined',
                                    $this->columnValue
                    ));
        }
        if (! in_array($this->columnValue[0], $this->legalChoice) ||
                 ! in_array($this->column_value[1], $this->legalChoice)) {
            throw new CheckDataException(
                    'Invalid value of \'' . self::COLUMN_FIRST . '\' OR \'' .
                     self::COLUMN_SECOND . '\'', $this->columnValue);
        }
        if (! $this->avaliable()) {
            throw new CheckDataException(
                    'Too much tech Choices or duplicate value', 
                    $this->columnValue);
        }
    }

    protected function avaliable ()
    {
        if (in_array($this->column_value[1], $this->techChoice) &&
                 in_array($this->column_value[0], $this->techChoice)) {
            return FALSE;
        } else {
            if ($this->column_value[0] == $this->column_value[1]) {
                return FALSE;
            }
        }
        return TRUE;
    }
}

