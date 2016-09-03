<?php

function autoLoad ($class_name)
{
    $file_path = str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file_path)) {
        include_once ($file_path);
    }
}

spl_autoload_register('autoLoad');

use \StandardRequest\Request;
use \Handler\HandlerSignUp;
use \Handler\HandlerEnd;
use Handler\HandlerInquiry;

class Client
{

    protected $Request;

    public function __construct ()
    {
        $this->Request = new Request();
        $handler = array(
                new HandlerSignUp(),
                new HandlerInquiry(),
                // End of the chain and it is used to throw the exception.
                new HandlerEnd()
        );
        // you can add the new handler in this array without any other operation
        for ($i = 1; $i < count($handler); $i ++) {
            $handler[$i-1]->setSuccessor($handler[$i]);
        }
        $handler[0]->handleRequest($this->Request);
    }
}

$Client = new Client();
?>