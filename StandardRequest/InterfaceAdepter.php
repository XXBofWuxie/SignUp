<?php
namespace StandardRequest;

abstract class InterfaceAdepter
{   
    protected $successor;//the next adepter

    protected $adepterName;//save the name of the 
    
    public function runAdepter() {
        if($this->confirm()) {
            return $this->core();
        } else {
            return $this->successor->runAdepter();
        }
    }
    
    public function setSuccessor ($successor)
    {
        $this->successor = $successor;
    }
    
    protected abstract function confirm();
    //return a bool value 
    
    protected abstract function core();
    //write adepter code here
}

