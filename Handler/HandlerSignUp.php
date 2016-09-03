<?php
namespace Handler;
use \Handler\InterfaceHandler as InterfaceHandler;
use \StandardRequest\Request as Request;

class HandlerSignUp extends InterfaceHandler
{

    public function __construct ()
    {
        $this->handler = 'SignUp';
    }

    public function handleRequest (Request $Request)
    {
        if ($this->handler == $Request->getHandler()) {
            $checkObj = array(
                    new \CheckData\CheckName($Request),
                    new \CheckData\CheckPhoneNumber($Request),
                    new \CheckData\CheckQQNumber($Request),
                    new \CheckData\CheckSex($Request),
                    new \CheckData\CheckDormitory($Request),
                    new \CheckData\CheckRoom($Request),
                    new \CheckData\CheckClassNumber($Request),
                    new \CheckData\CheckChoice($Request),
                    new \CheckData\CheckBirthday($Request),
                    new \CheckData\CheckShortPhoneNumber($Request),
                    new \CheckData\CheckAceptSwap($Request),
                    new \CheckData\CheckTextArea($Request),
                    new \CheckData\CheckEnd($Request)
            );
            for ($i = 1, $j = count($checkObj); $i < $j; $i ++) {
                $checkObj[$i - 1]->setNext($checkObj[$i]);
            }
            $check_result = $checkObj[0]->startCheck();
            if ($check_result) {
                $PDO = \Database\StaticPdo::DBConnect();
                $exist = \Database\DatabaseInfoExist::infoExist($PDO, 'member', 
                        array(
                                'QQNumber' => $Request->QQNumber
                        ));
                if (! $exist) {
                    $DBInsert = new \Database\DatabaseInsert('member');
                    $result = $DBInsert->setColumn(
                            array(
                                    'Sex',
                                    'Name',
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
                            ))
                        ->setValue(16)
                        ->startInsert($PDO, 
                            array(
                                    $Request->Sex,
                                    $Request->Name,
                                    $Request->Birthday,
                                    $Request->QQNumber,
                                    $Request->PhoneNumber,
                                    $Request->ShortPhoneNumber,
                                    $Request->Dormitory,
                                    $Request->Room,
                                    $Request->ClassNumber,
                                    $Request->FirstChoice,
                                    $Request->SecondChoice,
                                    $Request->AceptSwap,
                                    $Request->Interest,
                                    $Request->SelfConception,
                                    $Request->SectorAwareness,
                                    $Request->Experience
                            ));
                    if ($result) {
                        setcookie(md5($Request->Name), 
                                md5($Request->Dormitory . $Request->Room), 
                                time() + 60 * 60 * 24 * 7);
                        echo json_encode(0);
                        exit();
                    } else {
                        // server error
                        error_log('Database insert info error.');
                        echo json_encode(5);
                        exit();
                    }
                } else {
                    // the info has already existed.
                    echo json_encode(2);
                    exit();
                }
            } else {
                // input data format error
                echo json_encode(1);
                exit();
            }
        } else {
            $this->successor->handleRequest($Request);
        }
    }
}

