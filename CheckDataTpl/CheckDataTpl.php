<?php
namespace CheckDataTpl;
use Factory\CheckDataFactory;
use StandardRequest\Request;

class CheckDataTpl implements InterfaceCheckDataTpl
{

    const DEBUG_DEF = FALSE;

    protected $debugMode;

    protected $checkDataFactory;
    
    /*
     * An array used to save the column the class check.
     */
    protected $checkColumn;

    public function __construct ()
    {
        $this->debugMode = self::DEBUG_DEF;
        $this->checkDataFactory = new CheckDataFactory();
    }

    public function setDebugMode (bool $debug_mode)
    {
        $this->debugMode = $debug_mode;
    }

    public function startCheck (Request $Request)
    {
        try {
            foreach ($this->checkColumn as $value) {
                $checkObj = $this->checkDataFactory->factoryMethod(array($value, $Request));
                $checkObj->startCheck();
            }
        } catch (\CheckData\CheckDataException $exception) {
            if ($this->debugMode) {
                var_dump($exception->getMessage());
                exit();
            } else {
                return $exception->getCode();
            }
        }
        return 0;
    }
}

