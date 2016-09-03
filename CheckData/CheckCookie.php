<?php
namespace CheckData;
use StandardRequest\Request;

class CheckCookie extends InterfaceCheckData
{

    public function __construct (Request $Request)
    {
        $this->column_value[] = md5($Request->Name);
        $this->column_value[] = md5($Request->Dormitory.$Request->Room);
    }

    public function startCheck ()
    {
        if (isset($_COOKIE[$this->column_value[0]])) {
            if ($_COOKIE[$this->column_value[0]] == $this->column_value[1]) {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

