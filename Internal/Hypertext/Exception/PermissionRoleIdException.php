<?php namespace ZN\Hypertext\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Exception;

class PermissionRoleIdException extends \Exception
{
    const lang = 
    [
        'tr'        => 'Bu kullanım için # tanımlaması yapınız!',
        'en'        => 'Do the # definition for this use!',
        'placement' => 
        [
            '#' => 'Permission::roleId()'
        ]
    ];
}