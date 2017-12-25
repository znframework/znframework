<?php namespace ZN\ViewObjects\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class PermissionRoleIdException extends \GeneralException
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