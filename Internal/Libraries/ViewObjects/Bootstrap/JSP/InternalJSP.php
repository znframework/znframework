<?php namespace ZN\ViewObjects\Bootstrap;

class InternalJSP extends \FactoryController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'if'                    => 'JSP\Statements::if',
            'elseif'                => 'JSP\Statements::elseif',
            'else'                  => 'JSP\Statements::else',
            'run'                   => 'JSP\Run::use',
            'ready'                 => 'JSP\Ready::use',
            'var'                   => 'JSP\Variable::var',
            'varch'                 => 'JSP\Variable::varch',
            'vardec'                => 'JSP\Variable::vardec',
            'varinc'                => 'JSP\Variable::varinc',
            'while'                 => 'JSP\Loops::while',
            'dowhile'               => 'JSP\Loops::dowhile',
            'for'                   => 'JSP\Loops::for',
            'alert'                 => 'JSP\Output::alert',
            'write'                 => 'JSP\Output::write',
            'prompt'                => 'JSP\Input::prompt',
            'val'                   => 'JSP\Input::val',
            'html'                  => 'JSP\Input::html',
            'text'                  => 'JSP\Input::text',
            'addeventlistener'      => 'JSP\Events::addeventlistener',
            'removeeventlistener'   => 'JSP\Events::removeeventlistener',
            'ajax'                  => 'JSP\Ajax::send',
        ]
    ];
}
