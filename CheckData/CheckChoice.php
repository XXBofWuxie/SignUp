<?php
namespace CheckData;
use StandardRequest\Request;

class CheckChoice extends InterfaceCheckData
{

    protected $legalChoice;

    protected $techChoice;

    public function __construct (Request $Request)
    {
        if (isset($Request->FirstChoice) && isset($Request->SecondChoice)) {
            $this->techChoice = array(
                    1,
                    2,
                    3
            );
            $this->legalChoice = array(
                    1,
                    2,
                    3,
                    4,
                    5,
                    6,
                    7,
                    8
            );
            $this->column_value[] = $Request->FirstChoice;
            $this->column_value[] = $Request->SecondChoice;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck ()
    {
        if ($this->column_value != NULL) {
            if (in_array($this->column_value[0], $this->legalChoice) &&
                     in_array($this->column_value[1], $this->legalChoice)) {
                if ($this->avaliable()) {
                    return $this->successor->startCheck();
                }
            }
        }
        return FALSE;
    }

    protected function avaliable ()
    {
        if (in_array($this->column_value[1], $this->techChoice) &&
                 in_array($this->column_value[0], $this->techChoice)) {
            return FALSE;
        } else {
            if ($this->column_value[0] == $this->column_value[1]) {
                return FALSE;
            }
        }
        return TRUE;
    }
}

