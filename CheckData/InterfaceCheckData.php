<?php
namespace CheckData;

use \StandardRequest\Request as Request;

abstract class InterfaceCheckData
{
    //use a const 'COLUMN' to show the column the class check
    //like 'const COLUMN = Birthday'
    protected $columnValue;
    
    abstract public function __construct(Request $Request);
    
    abstract public function startCheck();
    //The entrance of starting check and it will throw a new Exception when facing error.
    
}

