<?php
namespace StandardRequest;

interface InterfaceStandardRequest
{
    public function getHandler();
    //返回选择的处理器
    
    public function __get($name);
    //返回其他的对应字段的值
    
    public function __isset($name);
}

