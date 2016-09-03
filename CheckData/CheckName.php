<?php
namespace CheckData;

use \StandardRequest\Request as Request;

class CheckName extends InterfaceCheckData
{
    const column = 'Name';
    
    const MAX_LENGTH = 4;
    
    const MIN_LENGTH = 2;
    
    public function __construct(Request $Request)
    {
        if(isset($Request->Name))
        {
            $this->column_value = $Request->Name;
        } else {
            $this->column_value = NULL;
        }
    }
    
    public function startCheck()
    {   
        if($this->column_value != NULL)
        {//when the Name column is set.
            if(preg_match('/^[\x{4e00}-\x{9fa5}]{'.self::MIN_LENGTH.','.self::MAX_LENGTH.'}/u', $this->column_value))
            {
                return $this->successor->startCheck();
            }
        }
        return FALSE;
    }
}

