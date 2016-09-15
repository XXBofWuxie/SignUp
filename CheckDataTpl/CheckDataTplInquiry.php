<?php
namespace CheckDataTpl;

class CheckDataTplInquiry extends CheckDataTpl
{

    public function __construct ()
    {
        $this->checkColumn = array(
                'Birthday',
                'Room',
                'Dormitory'
        );
        parent::__construct();
    }
}

