<?php
namespace CheckData;
use StandardRequest\Request;

class CheckBirthday extends InterfaceCheckData
{

    protected $replace;

    protected $search;

    public function __construct (Request $Request)
    {
        if (isset($Request->Birthday)) {
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
            $this->column_value = str_replace($this->search, $this->replace, 
                    $Request->Birthday);
            // after handling, the date is "31 8 2016"
            $this->column_value = explode(' ', $this->column_value);
            // array('day','month','year')
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value[2] > 1993 && $this->column_value[2] < 2002) {
            if (checkdate($this->column_value[1], $this->column_value[0], 
                    $this->column_value[2])) {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

