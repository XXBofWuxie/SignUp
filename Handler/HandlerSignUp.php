<?php
namespace Handler;
use \Handler\InterfaceHandler;
use \StandardRequest\Request;
use CheckDataTpl\CheckDataTplSignUp;
use Database\StaticPdo;
use Database\DatabaseInsert;

class HandlerSignUp extends InterfaceHandler
{

    public function __construct ()
    {
        $this->handler = 'SignUp';
    }

    public function handleRequest (Request $Request)
    {
        $checkDataTpl = new CheckDataTplSignUp();
        $checkDataTpl->setDebugMode(TRUE);
        $check_result = $checkDataTpl->startCheck($Request);
        if ($check_result) {
            echo json_encode($check_result);
            exit();
        }
        $staticPDO = new StaticPdo();
        $PDO = $staticPDO->DBConnect();
        if ($PDO) {
            echo json_encode(5);
            exit();
        }
        $DBInsert = new DatabaseInsert();
        $insert_result = $DBInsert->setTableName('SignUp')
            ->setColumn(array())
            ->setValue()
            ->startInsert($PDO, array());
        if($insert_result) {
            echo json_encode(0);
            exit();
        } else {
            echo json_encode(5);
            exit();
        }
    }
}







