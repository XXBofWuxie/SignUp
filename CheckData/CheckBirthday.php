<?php
namespace CheckData;
use StandardRequest\Request;

class CheckBirthday extends InterfaceCheckData
{

    protected $replace;

    protected $search;

    const COLUMN = 'Birthday';

    const YEAR_MIN = 1993;

    const YEAR_MAX = 2002;

    public function __construct (Request $Request)
    {
        if (isset($Request->{self::COLUMN})) {
            $this->search = array(
                    ',',
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
            );
            $this->replace = array(
                    '',
                    1,
                    2,
                    3,
                    4,
                    5,
                    6,
                    7,
                    8,
                    9,
                    10,
                    11,
                    12
            );
            // origin pattern is "31 August, 2016"
            $this->columnValue = str_replace($this->search, $this->replace, 
                    $Request->{self::COLUMN});
            // after handling, the date is "31 8 2016"
            $this->columnValue = explode(' ', $this->columnValue);
            // array('day','month','year')
        } else {
            $this->columnValue = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value === NULL) {
            throw new CheckDataException(
                    array(
                            'Column \''.self::COLUMN.'\' undefined',
                            $this->columnValue
                    ));
        }
        if ($this->column_value[2] < self::YEAR_MIN ||
                 $this->column_value[2] > self::YEAR_MAX) {
            throw new CheckDataException(
                    array(
                            'Invalid value of \''.self::COLUMN.'-Year\'',
                            $this->column_value
                    ));
        }
        if (! checkdate($this->column_value[1], $this->column_value[0], 
                $this->column_value[2])) {
            throw new CheckDataException(
                    array(
                            'Invalid date of \''.self::COLUMN.'\'',
                            $this->column_value
                    ));
        }
    }
}


