<?php
namespace CheckData;
use StandardRequest\Request;

class CheckStdId extends InterfaceCheckData
{

    public function __construct (Request $Request)
    {
        if (isset($Request->StdId)) {
            $this->column_value = $Request->StdId;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value !== NULL) {
            if (preg_match('2016\d{8}', $this->column_value)) {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

