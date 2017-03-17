<?php namespace ZN\ViewObjects\Bootstrap;

use JQ;

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
            'addeventlistener'      => 'JSP\Events::addeventlistener',
            'removeeventlistener'   => 'JSP\Events::removeeventlistener',
            'ajax'                  => 'JSP\Ajax::create',
            'animate'               => 'JSP\Animate::create',
            'fadeout'               => 'JSP\Action::fadeOut',
            'fadein'                => 'JSP\Action::fadeIn',
            'fadeto'                => 'JSP\Action::fadeTo',
            'slideup'               => 'JSP\Action::slideUp',
            'slidedown'             => 'JSP\Action::slideDown',
            'slidetoggle'           => 'JSP\Action::slideToggle',
            'show'                  => 'JSP\Action::show',
            'hide'                  => 'JSP\Action::hide',
            'function'              => 'JSP\Functions::define',
            'attr'                  => 'JSP\JqueryMethods::attr',
            'val'                   => 'JSP\JqueryMethods::val',
            'html'                  => 'JSP\JqueryMethods::html',
            'text'                  => 'JSP\JqueryMethods::text',
            'query'                 => 'JSP\Query::create',
            'selector'              => 'JSP\Query::selector',
            'property'              => 'JSP\Query::property',
            'complete'              => 'JSP\Query::create',
        ]
    ];
}
