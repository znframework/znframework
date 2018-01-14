<?php namespace ZN\Authorization;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\FactoryController;

class Permission extends FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'start'   => 'Process::start',
            'end'     => 'Process::end',
            'process' => 'Process::use',
            'page'    => 'Page::use',
            'post'    => 'Method::post',
            'get'     => 'Method::get',
            'request' => 'Method::request',
            'method'  => 'Method::use',
            'roleid'  => 'PermissionExtends::roleId'
        ]
    ];
}
