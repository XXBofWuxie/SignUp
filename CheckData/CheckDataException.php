<?php
namespace CheckData;

class CheckDataException extends \Exception
{
    /*
     * $Message is an array in this Exception class
     * The first parameter save the info of exception
     * The Second parameter save the raw value of the column
     * 
     * example:
     * $Message = array(
     *      'Error message',
     *      $column_value
     * )
     */
}

