<?php
namespace Factory;

use Factory\InterfaceFactory;

class HandlerFactory implements InterfaceFactory
{
    const PREFIX_DEF = 'Handler';
    
    protected $prefix;
    
    public function __construct ()
    {
        $this->prefix = self::PREFIX_DEF;
    }

    public function factoryMethod ($info)
    {
        $handler = new $this->prefix.$info();
        return $handler;
    }

    public function setPrefix ($prefix)
    {
        $this->prefix = $prefix;
    }
    
}

