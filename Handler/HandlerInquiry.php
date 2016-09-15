<?php
namespace Handler;
use StandardRequest\Request;
use CheckDataTpl\CheckDataTplInquiry;
use Database\DatabaseSelect;
use Database\StaticPdo;

class HandlerInquiry extends InterfaceHandler
{

    public function __construct ()
    {
        $this->handler = 'Inquiry';
    }

    public function handleRequest (Request $Request)
    {
        $checkTpl = new CheckDataTplInquiry();
        $checkTpl->setDebugMode(TRUE);
        $check_result = $checkTpl->startCheck($Request);
        if ($check_result != 0) {
            echo json_encode($check_result);
            exit();
        }
        $staticPDO = new StaticPdo();
        $PDO = $staticPDO->DBConnect();
        if ($PDO) {
            json_encode(6);
            exit();
        }
        $DBSelect = new DatabaseSelect();
        $result = $DBSelect->setColumnName(array(
                '*'
        ))
            ->setTable('SignUp')
            ->setWhere(array(
                'Name',
                'Dormitory',
                'Room'
        ))
            ->setLimitMax(1)
            ->startSelect($PDO, 
                array(
                        $Request->Name,
                        $Request->Dormitory,
                        $Request->Room
                ));
        if ($result === FALSE) {
            echo json_encode(5);
            exit();
        } else 
            if (count($result)) {
                echo json_encode($result);
                exit();
            } else {
                echo json_encode(2);
                exit();
            }
    }
}

