<?php namespace ZN\Components;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\Factory;

class Builder extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'datatable'         => 'Datatables\Build::generate',
            'chart'             => 'Charts\Build::generate',
            'datepicker'        => 'Datepicker\Build::generate',
            'select2'           => 'Select2\Build::generate',
            'flexslider'        => 'FlexSlider\Build::generate',
            'form'              => 'Form\Build::generate',
            'aceeditor'         => 'AceEditor\Build::generate',
            'tinymceeditor'     => 'TinymceEditor\Build::generate',
            'pagination'        => 'Pagination\Build::generate',
            'modalbox'          => 'Modal\Build::generate',
            'gridsystem'        => 'GridSystem\Build::generate',
            'dropdown'          => 'Dropdown\Build::generate',
            'tab'               => 'Tabs\Build::generate',
            'pill'              => 'Tabs\Build::pill'
        ]
    ];

    /**
     * Selects extensions
     * 
     * @param array $extensions
     * @param array $parameters
     * @param bool  $autoloadExtensions
     * 
     * @return array
     */
    public function extensions($extensions, $parameters, $autoloadExtensions)
    {
        if( $autoloadExtensions === true )
        {
            return array_merge($parameters, (array) $extensions);
        }

        return $extensions;
    }
}
