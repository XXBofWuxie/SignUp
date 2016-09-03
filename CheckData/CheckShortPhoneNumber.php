<?php
namespace CheckData;
use StandardRequest\Request;

class CheckShortPhoneNumber extends InterfaceCheckData
{

    public function __construct (Request $Request)
    {
        if (isset($Request->ShortPhoneNumber)) {
            $this->column_value = $Request->ShortPhoneNumber;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value !== NULL) {
            if (preg_match('/^\d{6}$/', $this->column_value) ||
                     $this->column_value == '') {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

