<?php
namespace CheckDataTpl;
use CheckData\CheckColumnSignUp;
use Factory\CheckDataFactory;
use StandardRequest\Request;

class CheckDataTplSignUp extends CheckColumnSignUp implements 
        InterfaceCheckDataTpl
{

    const DEBUG_DFT = FALSE;

    protected $debugMode;
    
    protected $checkDataFactory;

    public function __construct ()
    {
        $this->debugMode = self::DEBUG_DFT;
        $this->checkDataFactory = new CheckDataFactory();
    }

    public function setDebugMode ($debug_mode)
    {
        $this->debugMode = $debug_mode;
    }

    public function startCheck (Request $Request)
    {
        foreach ($this->checkColumn as $key => $value) {
            $this->checkColumn[$key] = $this->checkDataFactory->factoryMethod(array($value, $Request));
        }
        try {
            foreach ($this->checkColumn as $value) {
                $value->startCheck();
            }
        } catch (\CheckData\CheckDataException $exception) {
            if($this->debugMode) {
                
            } else {
                echo json_encode(1);
                exit();
            }
        }
    }
}

