<?php
namespace CheckData;

use StandardRequest\Request;

class CheckEnd extends InterfaceCheckData
{

    public function __construct(Request $Request)
    {}

    public function startCheck()
    {
        return TRUE;
    }
}

