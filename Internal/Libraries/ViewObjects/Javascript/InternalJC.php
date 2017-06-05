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
            'datatable'  => 'Javascript\Components\Datatables::generate',
            'chart'      => 'Javascript\Components\Charts::generate',
            'datepicker' => 'Javascript\Components\Datepicker::generate',
            'select2'    => 'Javascript\Components\Select2::generate',
            'flexslider' => 'Javascript\Components\FlexSlider::generate',
            'validation' => 'Javascript\Components\Validation::generate',
            'aceeditor'  => 'Javascript\Components\AceEditor::generate',
            'pagination' => 'Javascript\Components\Pagination::generate',
            'modalbox'   => 'Javascript\Components\Modal::generate',
            'gridsystem' => 'Javascript\Components\GridSystem::generate'
        ]
    ];
}
