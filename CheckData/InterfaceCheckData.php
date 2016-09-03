<?php
namespace CheckData;

use \StandardRequest\Request as Request;

abstract class InterfaceCheckData
{
    //use a const to show the column the class check
    
    protected $successor;
    
    protected $column_value;
    
    abstract public function __construct(Request $Request);
    
    abstract public function startCheck();
    //the entrance of starting check, return a bool value 
    
    public function setNext(InterfaceCheckData $next)
    {
        $this->successor = $next;
    }
    //set the next check element
}

