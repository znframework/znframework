<?php namespace ZN\Requirements;

class Requirements extends \CallController implements RequirementsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use ConfigTrait, StatusTrait;

    public function __destruct()
    {
        $this->config = NULL;
        $this->lang   = NULL;
    }
}

class_alias('ZN\Requirements\Requirements', 'Requirements');