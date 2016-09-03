<?php
namespace CheckData;
use StandardRequest\Request;

class CheckAceptSwap extends InterfaceCheckData
{

    public function __construct (Request $Request)
    {
        if (isset($Request->AceptSwap)) {
            $this->column_value = $Request->AceptSwap;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if($this->column_value != NULL){
            switch ($this->column_value){
                case '0':
                case '1': return $this->successor->startCheck();
            }
        } 
        return FALSE;
    }
}

