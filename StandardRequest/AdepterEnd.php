<?php
namespace StandardRequest;

class AdepterEnd extends InterfaceAdepter
{

    public function __construct ()
    {}

    protected function confirm ()
    {
        return TRUE;
    }

    protected function core ()
    {
        throw new \Exception('Can\'t find suitable adepter');
    }
}

