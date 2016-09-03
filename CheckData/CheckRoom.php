<?php
namespace CheckData;
use StandardRequest\Request;

class CheckRoom extends InterfaceCheckData
{

    public function __construct (Request $Request)
    {
        if (isset($Request->Room)) {
            $this->column_value = $Request->Room;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value != NULL) {
            if (preg_match('/^\d{3}$/', $this->column_value)) {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

