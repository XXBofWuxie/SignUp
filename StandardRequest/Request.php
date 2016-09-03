<?php
namespace StandardRequest;

class Request implements InterfaceStandardRequest
{

    protected $post;

    public function __construct (bool $use_adepter)
    {
        if ($use_adepter) {
            $this->useAdepter();
        } else {
            $this->noAdepter();
        }
    }

    protected function useAdepter ()
    {
        $adepterTemplate = new RequestAdepterTemplate();
        $this->post = $adepterTemplate->useAdepter();
    }

    protected function noAdepter ()
    {
        if (get_magic_quotes_gpc()) { // check if the magic method is used.
            foreach ($_POST as $key => $value) {
                $this->post[$key] = trim($value);
            }
        } else {
            foreach ($_POST as $key => $value) {
                $this->post[$key] = addslashes(trim($value));
            }
        }
    }

    public function __get ($name)
    {
        return $this->post[$name];
    }

    public function __isset ($name)
    {
        return isset($this->post[$name]);
    }

    public function getHandler ()
    {
        return $this->post['Handler'];
    }
}

