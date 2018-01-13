<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class JC extends \FactoryController
{
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
