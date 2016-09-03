<?php
namespace CheckData;

use StandardRequest\Request;

class CheckPhoneNumber extends InterfaceCheckData
{

    public function __construct(Request $Request)
    {
        if(isset($Request->PhoneNumber))
        {
            $this->column_value = trim($Request->PhoneNumber);
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck()
    {
        if(preg_match('/^1[3|4|5|7|8]\d{9}$/', $this->column_value))
        {
            return $this->successor->startCheck();
        }
        return FALSE;
    }
}

