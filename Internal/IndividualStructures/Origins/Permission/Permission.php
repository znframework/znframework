<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Permission extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'start'   => 'Permission\Process::start',
            'end'     => 'Permission\Process::end',
            'process' => 'Permission\Process::use',
            'page'    => 'Permission\Page::use',
            'post'    => 'Permission\Method::post',
            'get'     => 'Permission\Method::get',
            'request' => 'Permission\Method::request',
            'method'  => 'Permission\Method::use',
            'roleid'  => 'Permission\PermissionExtends::roleId'
        ]
    ];
}
