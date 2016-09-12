<?php namespace ZN\Requirements\Controllers;

use ZN\Requirements\Abilities\Configurable;
use ZN\Requirements\Abilities\Conversation;
use ZN\Requirements\Abilities\Information;

class AbilityController extends BaseController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Usage
    //--------------------------------------------------------------------------------------------------------
    //
    // Abilities
    //
    //--------------------------------------------------------------------------------------------------------
    use Configurable, Conversation, Information;

    //--------------------------------------------------------------------------------------------------------
    // Magic Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->configurable();
        $this->conversation();
    }
}

class_alias('ZN\Requirements\Controllers\AbilityController', 'AbilityController');
