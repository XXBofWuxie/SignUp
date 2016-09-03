<?php
namespace CheckData;
use StandardRequest\Request;

class CheckTextArea extends InterfaceCheckData
{

    public function __construct (Request $Request)
    {
        $this->column_value = isset($Request->Interest) &&
                 isset($Request->SelfConception) &&
                 isset($Request->SectorAwareness) && isset($Request->Experience);
        if ($this->column_value) {
            $this->column_value = strlen($Request->Interest) &&
                     strlen($Request->SelfConception) &&
                     strlen($Request->SectorAwareness) &&
                     strlen($Request->Experience) &&
                     (mb_strlen($Request->Interest) < 129) &&
                     (mb_strlen($Request->SelfConception) < 129) &&
                     (mb_strlen($Request->SectorAwareness) < 129) &&
                     (mb_strlen($Request->Experience) < 129);
        }
    }

    public function startCheck ()
    {
        if ($this->column_value) {
            return $this->successor->startCheck();
        } else {
            return FALSE;
        }
    }
}

