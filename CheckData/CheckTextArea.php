<?php
namespace CheckData;
use StandardRequest\Request;

class CheckTextArea extends InterfaceCheckData
{

    const COLUMN = 'TextArea';

    const COLUMN_DTL = array(
            'Interest',
            'SelfConception',
            'SectorAwareness',
            'Experience'
    );

    const MAX_LENGTH = 128;

    const MIN_LENGTH = 0;

    public function __construct (Request $Request)
    {
        $this->column_value['exist'] = 
                 isset($Request->{self::COLUMN_DTL[0]}) &&
                 isset($Request->{self::COLUMN_DTL[1]}) &&
                 isset($Request->{self::COLUMN_DTL[2]}) &&
                 isset($Request->{self::COLUMN_DTL[3]});
        if ($this->column_value) {
            $this->column_value['length'] = 
                     (mb_strlen($Request->{self::COLUMN_DTL[0]}) >= self::MIN_LENGTH) &&
                     (mb_strlen($Request->{self::COLUMN_DTL[1]}) >= self::MIN_LENGTH) &&
                     (mb_strlen($Request->{self::COLUMN_DTL[2]}) >= self::MIN_LENGTH) &&
                     (mb_strlen($Request->{self::COLUMN_DTL[3]}) >= self::MIN_LENGTH) &&
                     (mb_strlen($Request->{self::COLUMN_DTL[0]}) <= self::MAX_LENGTH) &&
                     (mb_strlen($Request->{self::COLUMN_DTL[1]}) <= self::MAX_LENGTH) &&
                     (mb_strlen($Request->{self::COLUMN_DTL[2]}) <= self::MAX_LENGTH) &&
                     (mb_strlen($Request->{self::COLUMN_DTL[3]}) <= self::MAX_LENGTH);
        }
    }

    public function startCheck ()
    {
        if (! $this->column_value['exist']) {
            throw new CheckDataException(
                    array(
                            'Element of set \'' . self::COLUMN . '\' undefined',
                            $this->columnValue
                    ));
        }
        if (! $this->columnValue['length']) {
            throw new CheckDataException(
                    array(
                            'Invalid element length of set \'' . self::COLUMN . '\'',
                            $this->columnValue
                    ));
        }
    }
}

