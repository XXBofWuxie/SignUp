<?php
namespace Handler;

use StandardRequest\Request as Request;

class RequestException extends \Exception {}

class HandlerEnd extends InterfaceHandler
{

    public function __construct()
    {
        $this->handler = 'End';
    }

    public function handleRequest(Request $request)
    {
        try{
            throw new RequestException('Invalid type of request.');
        } catch (RequestException $Exception) {
            error_log($Exception->getMessage(), 0);
        }
        return json_encode(6);
    }
}

