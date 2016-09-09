<?php
namespace CheckDataTpl;
use StandardRequest\Request;

Interface InterfaceCheckDataTpl
{

    public function setDebugMode ($debug_mode);

    public function startCheck (Request $Request);
}

