<?php
namespace CheckDataTpl;
use StandardRequest\Request;

interface InterfaceCheckDataTpl
{

    const DEBUG_DEF = FALSE;

    /**
     * Set the debug mode.
     *
     * @param bool $debug_mode
     *            <p>Default to FALSE.(Cloing debug mode.)</p>
     */
    public function setDebugMode (bool $debug_mode);

    /**
     * Start the checking.
     * As the debug mode is on, the script will exit when encountered errors.
     *
     * @param Request $Request            
     * @return int zero on success or greater than zero on failure.
     */
    public function startCheck (Request $Request);
}

