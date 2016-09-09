<?php
namespace Factory;

interface InterfaceFactory
{

    public function setPrefix ($prefix);
    // reset the prefix of the product

    public function factoryMethod ($info);
    // return a product base on the info
}

