<?php
namespace CheckData;

use StandardRequest\Request;

class CheckSex extends InterfaceCheckData
{

    public function __construct(Request $Request)
    {
        if(isset($Request->Sex))
        {
            $this->column_value = $Request->Sex;
        } else {
            $this->column_value = NULL;
        }
    }

    public function startCheck()
    {
        if($this->column_value != NULL)
        {
            $Sex = array( 0, 1 );
            if( in_array($this->column_value, $Sex) )
            {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

