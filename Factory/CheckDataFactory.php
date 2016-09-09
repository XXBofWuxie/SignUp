<?php
namespace Factory;

class CheckDataFactory implements InterfaceFactory
{

    protected $prefix;

    const PREFIX_DEF = 'Check';

    public function __construct ()
    {
        $this->prefix = self::PREFIX_DEF;
    }

    
    /**
     * {@inheritDoc}
     * Array $info
     *  key-column_name   the name of the column
     *  key-Request       StandardRequest $Request
     * @see \Factory\InterfaceFactory::factoryMethod()
     */
    public function factoryMethod ($info)
    {
        $checkData = new $this->prefix . $info['column_name']($info['Request']);
        return $checkData;
    }

    public function setPrefix ($prefix)
    {
        $this->prefix = $prefix;
    }
}

