<?php
namespace Handler;
use StandardRequest\Request;
use Database;

class HandlerInquiry extends InterfaceHandler
{

    public function __construct ()
    {
        $this->handler = 'Inquiry';
    }

    public function handleRequest (Request $Request)
    {
        if ($Request->getHandler() == $this->handler) {
            $checkObj = array(
                    new \CheckData\CheckName($Request),
                    new \CheckData\CheckDormitory($Request),
                    new \CheckData\CheckRoom($Request),
                    new \CheckData\CheckEnd($Request)
            );
            for ($i = 1; $i < count($checkObj); $i ++) {
                $checkObj[$i - 1]->setNext($checkObj[$i]);
            }
            if ($checkObj[0]->startCheck()) {
                $PDO = \Database\StaticPdo::DBConnect();
                $checkCookie = array(
                        new \CheckData\CheckCookie($Request),
                        new \CheckData\CheckEnd($Request)
                );
                $checkCookie[0]->setNext($checkCookie[1]);
                if (! $checkCookie[0]->startCheck()) {
                    $if_exist = \Database\DatabaseInfoExist::infoExist($PDO, 
                            'member', 
                            array(
                                    'Name' => $Request->Name,
                                    'Dormitory' => $Request->Dormitory,
                                    'Room' => $Request->Room
                            ));
                    if (! $if_exist) {
                        //can't find the sign up info
                        echo json_encode(2);
                        exit();
                    }
                }
                $DBSelect = new \Database\DatabaseSelect('member', 
                        array(
                                'Name',
                                'Sex',
                                'Birthday',
                                'QQNumber',
                                'PhoneNumber',
                                'ShortPhoneNumber',
                                'Dormitory',
                                'Room',
                                'ClassNumber',
                                'FirstChoice',
                                'SecondChoice',
                                'AceptSwap',
                                'Interest',
                                'SelfConception',
                                'SectorAwareness',
                                'Experience'
                        ));
                $result = $DBSelect->setWhere(
                        array(
                                'Name',
                                'Dormitory',
                                'Room'
                        ))->startSelect($PDO, 
                        array(
                                $Request->Name,
                                $Request->Dormitory,
                                $Request->Room
                        ));
                if (count($result)) {
                    foreach ($result[0] as $v) {
                        if (is_string($v)) {
                            $v = htmlspecialchars($v);
                        }
                    }
                    echo json_encode($result);
                    exit();
                } else {
                    //server error
                    error_log('Database select info error.');
                    echo json_encode(5);
                    exit();
                }
            } else {
                //input data format error
                echo json_encode(1);
                exit();
            }
        } else {
            $this->successor->handleRequest($Request);
        }
    }
}

