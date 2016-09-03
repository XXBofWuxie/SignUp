<?php
namespace Handler;

use \StandardRequest\Request as Request;

abstract class InterfaceHandler
{
    protected $handler;
    
    protected $successor = NULL;
    
    public function setSuccessor(InterfaceHandler $next_handler)
    {
        $this->successor = $next_handler;
    }
    
    abstract public function handleRequest(Request $Request);
}

