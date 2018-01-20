<?php namespace ZN\Language;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class GridDefaultConfiguration
{
   /*
    |--------------------------------------------------------------------------
    | ML Grid
    |--------------------------------------------------------------------------
    |
    | It edits the table created by the ML::table() method.
    |
    | styleElement: Used to give built-in style to the table.
    | attributes  : Used to add attributes to objects in the table.
    | pagination  : It arranges the pagination bar on the table.
    |
    */

    public $styleElement =
    [
        #'#ML_TABLE tr:nth-child(even)' => ['background' => '#E6F9FF'],
        #'#ML_TABLE tr:nth-child(odd)'  => ['background' => '#FFF']
    ];

    public $attributes =
    [
        'table'   => ['class' => 'table table-bordered table-hover table-striped'],
        'add'     => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
        'update'  => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
        'delete'  => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
        'clear'   => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
        'textbox' => ['style' => 'height:30px; color:#0085B2; border:solid 1px #ccc; text-indent:10px; border-radius:4px']
    ];

    public $pagination =
    [
        'style' =>
        [
            'links' => 'color:#0085B2; width:30px; height:30px; text-align:center; padding-top:4px;
                        display:inline-block; background:white; border:solid 1px #ddd; border-radius: 4px;
                        -webkit-border-radius: 4px; -moz-border-radius: 4px;text-decoration:none;',

            'current' => 'font-weight:bold;'
        ],
        'class' => []
    ];
}
