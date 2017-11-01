<?php namespace ZN\ViewObjects;

class InternalJC extends \FactoryController
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
            'datatable'         => 'Javascript\Components\Datatables::generate',
            'chart'             => 'Javascript\Components\Charts::generate',
            'datepicker'        => 'Javascript\Components\Datepicker::generate',
            'select2'           => 'Javascript\Components\Select2::generate',
            'flexslider'        => 'Javascript\Components\FlexSlider::generate',
            'form'              => 'Javascript\Components\Form::generate',
            'aceeditor'         => 'Javascript\Components\AceEditor::generate',
            'tinymceeditor'     => 'Javascript\Components\TinymceEditor::generate',
            'pagination'        => 'Javascript\Components\Pagination::generate',
            'modalbox'          => 'Javascript\Components\Modal::generate',
            'gridsystem'        => 'Javascript\Components\GridSystem::generate',
            'dropdown'          => 'Javascript\Components\Dropdown::generate',
            'tab'               => 'Javascript\Components\Tabs::generate',
            'pill'              => 'Javascript\Components\Tabs::pill',
            'ajax'              => 'Javascript\Components\Ajax::generate'
        ]
    ];

    public function extensions($extensions, $parameters, $autoloadExtensions)
    {
        if( $autoloadExtensions === true )
        {
            return array_merge($parameters, (array) $extensions);
        }

        return $extensions;
    }
}
