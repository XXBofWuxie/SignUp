<?php
namespace StandardRequest;

class RequestAdepterTemplate extends InterfaceRequestAdepterTemplate
{

    public function __construct ()
    {
        $this->debugMode = self::DEBUG_DF;
        $this->adepter = array(
                new AdepterFile(),
                new AdepterSingleFile(),
                new AdepterEnd()
        );
        for ($i = 1; $i < count($this->adepter); $i ++) {
            $this->adepter[$i - 1]->setSuccessor($this->adepter[$i]);
        }
    }

    public function useAdepter ()
    {
        try{
            $post = $this->adepter[0]->runAdepter();
        }catch (\Exception $e) {
            if($this->debugMode) {
                echo json_encode($e->getMessage());
            } else {
                error_log($e->getMessage());
            }
            exit();
        }
        return $post;
    }
}

