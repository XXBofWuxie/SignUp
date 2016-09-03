<?php
namespace CheckData;
use StandardRequest\Request;

class CheckClassNumber extends InterfaceCheckData
{

    protected $legalClass;

    public function __construct (Request $Request)
    {
        if (isset($Request->ClassNumber)) {
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
            $this->column_value = $Request->ClassNumber;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value !== NULL) {
            if (in_array($this->column_value, $this->legalClass)) {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

