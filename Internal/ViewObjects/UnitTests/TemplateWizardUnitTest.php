<?php namespace ZN\ViewObjects;

class TemplateWizardUnitTest extends \UnitTestController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const unit =
    [
        'class'   => 'TemplateWizard',
        'methods' => 
        [
            'isolation'         => ['Example Data'],
            'data'              => ['{{$data}}', ['data' => 10]]
        ]
    ];
}
