<?php
namespace StandardRequest;

class AdepterSingleFile extends InterfaceAdepter
{

    public function __construct ()
    {
        $this->adepterName = 'SingleFile';
    }

    protected function confirm ()
    {
        if(isset($_FILES['name'])) {
            if(!is_array($_FILES['name'])) {
                return TRUE;
            }
        }
        return FALSE;
    }

    protected function core ()
    {
        $post = $_FILES;
        $post['Handler'] = $this->adepterName;
        return $post;
    }
}

