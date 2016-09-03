<?php
namespace CheckData;
use StandardRequest\Request;

class CheckQQNumber extends InterfaceCheckData
{

    public function __construct (Request $Request)
    {
        if (isset($Request->QQNumber)) {
            $this->column_value = $Request->QQNumber;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if (preg_match('/^[1-9]\d{4,9}$/', $this->column_value) ||
                 $this->column_value == '') {
            return $this->successor->startCheck();
        }
        return FALSE;
    }
}
