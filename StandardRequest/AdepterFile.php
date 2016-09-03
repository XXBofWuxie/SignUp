<?php
namespace StandardRequest;

class AdepterFile extends InterfaceAdepter
{
    
    public function __construct ()
    {
        $this->adepterName = 'File';
    }

    protected function confirm ()
    {
        if(isset($_FILES['name'])) {
            if(is_array($_FILES['name'])) {
                return TRUE;
            }
        }
        return FALSE;
    }

    protected function core ()
    {
        foreach ($_FILES as $key1 => $value1) {
            foreach ($value1 as $key2 => $value2) {
                $post[$key2][$key1] = $value2;
            }
        }
        return $post;
    }
}

