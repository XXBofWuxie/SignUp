<?php
namespace StandardRequest;

abstract class InterfaceRequestAdepterTemplate
{

    const DEBUG_DF = FALSE;

    protected $adepter;
    // save the adepter when construct this class
    
    protected $debugMode;
    // default value is FALSE
    
    public abstract function useAdepter ();

    public function setDebugMode (bool $debug_mode)
    {
        $this->debugMode = $debug_mode;
    }
}

