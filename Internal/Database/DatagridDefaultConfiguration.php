<?php namespace ZN\Database;
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
class DatagridDefaultConfiguration
{
   /*
    |--------------------------------------------------------------------------
    | Datagrid
    |--------------------------------------------------------------------------
    |
    | Includes default settings for the datagrids.
    |
    */

    protected $styleElement =
    [
        '#DBGRID_TABLE tr:nth-child(even)' => ['background' => '#E6F9FF'],
        '#DBGRID_TABLE tr:nth-child(odd)'  => ['background' => '#FFF']
    ];

    protected $attributes =
    [
        'table'         => ['width' => '100%', 'cellspacing' => 0, 'cellpadding' => 10, 'style' => 'margin-top:15px; margin-bottom:15px; border:solid 1px #ddd; font-family:Arial; color:#888; font-size:14px;'],
        'editTables'    => ['style' => 'font-family:Arial; color:#888; font-size:14px;'],
        'columns'       => ['height' => 75, 'style' => 'text-decoration:none; color:#0085B2'],
        'search'        => ['style' => 'height:34px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
        'add'           => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
        'deleteSelected'=> ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
        'deleteAll'     => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
        'save'          => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
        'update'        => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
        'delete'        => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
        'edit'          => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
        'listTables'    => [],
        'inputs'        =>
        [
            'text'      => ['style' => 'height:34px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
            'textarea'  => ['style' => 'height:120px; width:290px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
            'radio'     => [],
            'checkbox'  => [],
            'select'    => []
        ]
    ];
    
    protected $pagination =
    [
        'style' =>
        [
            'links'   => 'color:#0085B2;width:30px; height:30px;text-align:center;padding-top:4px;display:inline-block;background:white;border:solid 1px #ddd;border-radius: 4px;-webkit-border-radius: 4px;-moz-border-radius: 4px;text-decoration:none;',
            'current' => 'font-weight:bold;'
        ]
    ];
}
