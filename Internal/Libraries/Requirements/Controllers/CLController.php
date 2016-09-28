<?php namespace ZN\Requirements\Controllers;

use ConfigurableAbility;
use ConversationAbility;

class CLController extends BaseController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Usage
    //--------------------------------------------------------------------------------------------------------
    //
    // Abilities
    //
    //--------------------------------------------------------------------------------------------------------
    use ConfigurableAbility, ConversationAbility;

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

class_alias('ZN\Requirements\Controllers\CLController', 'CLController');
