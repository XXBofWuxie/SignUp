<?php

function autoLoad ($class_name)
{
    $file_path = str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file_path)) {
        include_once ($file_path);
    }
}

spl_autoload_register('autoLoad');

use StandardRequest\Request;
use Factory\HandlerFactory;

class Client
{

    protected $Request;

    public function __construct ()
    {
        $this->Request = new Request(TRUE);
        $handlerFactory = new HandlerFactory();
        $handler = $handlerFactory->factoryMethod($this->Request);
        $handler->handleRequest($this->Request);
    }
}

$Client = new Client();
?>